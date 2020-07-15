<?
class SVG
{	
	// size
	protected $width = "100%";
	protected $height = "100%";
	//protected $width = "560px";
	//protected $height = "400px";

	// axis > space
	protected $x_num = 6;						protected $y_num = 4;
	protected $x_minimum = -100;			protected $y_minimum = 5;

	// axis > point corner
	protected $x_topLeft = 15;					protected $y_topLeft = 10;
	protected $x_topRight = 85;				protected $y_topRight = 10;
	protected $x_bottomRight = 85;			protected $y_bottomRight = 80;
	protected $x_bottomLeft = 15;			protected $y_bottomLeft = 80;
	
	// axis > line
	protected $line_width = 0.25;
	protected $line_min = 0.1;

	// font
	protected $font_size = "4.5";
	protected $font_min = "2.5";
	protected $font_family = "Arial, Helvetica, sans-serif";
	protected $font_anchor = "middle";

	// color
	protected $color_tran = "transparent";
	protected $color_black = "black";
	protected $color_white = "white";
	protected $color_blue = "#3cd5fe";
	protected $color_brown = "#8c5c4a";
	protected $color_yel = "yellow";
	protected $color_red = "red";

	// file
	protected $file_path = "../../data/img/cross/";
	protected $file_type = ".txt";




	// set array
	public function crossSection($id, $wl, $lv1, $lv2, $bm, $zg, $bd, $left, $right)
	{
		// define
		$x = $this->line("x", $id);
		$y = $this->line("y", $id);
		$wl = ( !empty($wl) ) ? $wl : 0;

		// start SVG
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" standalone=\"no\"?>\n";
		echo "<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
		echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"".$this->width."\" height=\"".$this->height."\" viewBox=\"0 0 100 100\" preserveAspectRatio=\"none\">\n";

		// water
		echo $this->water('build', $y, $wl)."\n";

		// terrain
		echo $this->terrain($x, $y)."\n";
		
		// axis X
		echo $this->axisX($x)."\n";
		
		// axis Y
		echo $this->axisY($y)."\n";

		// guide
		echo $this->guideLine($y, $lv1, $this->color_yel, 5, 1.5, "Warning")."\n";
		echo $this->guideLine($y, $lv2, $this->color_red, 4.5, -0.5, "Danger")."\n";
		//echo $this->guideLine($y, $bd, $this->color_white, 6, 2, "River Bed")."\n";
		echo $this->guideLine($y, $zg, $this->color_white, 6.75, 0, "Zero Gauge")."\n";
		echo $this->guideText($y, $left, $this->x_bottomLeft, 10, "Left Bank")."\n";
		echo $this->guideText($y, $right, $this->x_bottomRight, -10, "Right Bank")."\n";
		
		// value
		echo $this->water('value', $y, $wl)."\n";

		// end SVG		
		echo "Sorry, your browser does not support inline SVG.\n";
		echo "</svg>";
	}




	// build terrain
	public function terrain($x_line, $y_line)
	{		
		/*$x_range = $this->_range("x", $x_line);
		$y_range = $this->_range("y", $y_line);
		$_allow = 0 + 0;

		// poly (start)
		$point =	$this->x_bottomLeft.",".$this->y_bottomLeft." ";

		for ( $i = 0; $i < count($x_line); $i++ )
		{			
			// convert
			$x = $this->limit("width", $x_range[0], $x_range[1], $x_line[$i]);
			$y = $this->limit("height", $y_range[0], $y_range[1], $y_line[$i]);
				
			// poly fake
			$point .= ( $_allow == 0 ) ? $this->x_bottomLeft.",".( $y - 2 )." " : "";
			
			// poly default
			$point .= $x.",".$y." ";

			$_allow++;
		}
		
		// poly fake
		$point .= $this->x_bottomRight.','.( $y - 2 )." ";
		
		// poly (end)
		$point .= $this->x_bottomRight.','.$this->y_bottomRight;
		
		$temp = "<polygon points=\"".$point."\" style=\"fill: ".$this->color_brown."\" />\n";*/

		$x_range = $this->_range("x", $x_line);
		$y_range = $this->_range("y", $y_line);
		$_allow = 0 + 0;

		$x = array();
		$y = array();

		for ( $i = 0; $i < count($x_line); $i++)
		{
			// convert
			$point_x = $this->limit("width", $x_range[0], $x_range[1], $x_line[$i]);
			$point_y = $this->limit("height", $y_range[0], $y_range[1], $y_line[$i]);

			if ($_allow == 0 && $point_x > $this->x_bottomLeft)
			{
				array_push($x, $this->x_bottomLeft);
				array_push($y, $point_y - 2);
			}

			array_push($x, $point_x);
			array_push($y, $point_y);

			$_allow++;
		}
		
		if ($point_x < $this->x_bottomRight)
		{
			array_push($x, $this->x_bottomRight);
			array_push($y, $point_y - 2);
		}

		/*$px = $this->computeControlPoints($x);
		$py = $this->computeControlPoints($y);
		
		$temp = "<path d=\"";
		$temp .= $this->pathStart($x[0], $y[0], $px[0][0], $py[0][0], $px[1][0], $py[1][0], $x[1], $y[1]);
		for ( $i = 1; $i < count($x_line); $i++)
			$temp .= $this->path($px[0][$i], $py[0][$i], $px[1][$i], $py[1][$i], $x[$i + 1], $y[$i + 1]);
			//$temp .= $this->pathStart($x[$i], $y[$i], $px[0][$i], $py[0][$i], $px[1][$i], $py[1][$i], $x[$i + 1], $y[$i + 1]);
		$temp .= "L".$this->x_bottomRight.",".$this->y_bottomRight."L".$this->x_bottomLeft.",".$this->y_bottomRight."z";
		//$temp .= "\" fill=\"".$this->color_brown."\" />";
		$temp .= "\" fill=\"none\" stroke='red'/>";*/

		$temp = "<path d=\"";
		$temp .= $this->makePath($x, $y);
		$temp .= "L".$this->x_bottomRight.",".$this->y_bottomRight."L".$this->x_bottomLeft.",".$this->y_bottomRight."z";
		$temp .= "\" fill=\"".$this->color_brown."\" />";

		for ( $i = 0; $i < count($x_line); $i++)
		{
			// convert
			$point_x = $this->limit("width", $x_range[0], $x_range[1], $x_line[$i]);
			$point_y = $this->limit("height", $y_range[0], $y_range[1], $y_line[$i]);
			$temp .= "<circle cx=\"".$point_x."\" cy=\"".$point_y."\" r=\".3\" stroke=\"none\" fill=\"red\" />";
		}
		return $temp;
	}

	public function makePath($x_points, $y_points) {
		$result = "M".$x_points[0].",".$y_points[0]." ";
		$catmull = $this->catmullRom2bezier($x_points, $y_points);
		for ( $i = 0; $i < count($catmull); $i++) {
			$result .= "C".$catmull[$i][0]["x"].",".$catmull[$i][0]["y"]." ".$catmull[$i][1]["x"].",".$catmull[$i][1]["y"]." ".$catmull[$i][2]["x"].",".$catmull[$i][2]["y"]." ";
		}
		return $result;
	}

	function catmullRom2bezier($x_points, $y_points) {
		$result = array();
		for ( $i = 0; $i < count($x_points) - 1; $i++) {
			$p = array();

			array_push($p, array("x" => $x_points[max($i - 1, 0)], "y" => $y_points[max($i - 1, 0)]));
			array_push($p, array("x" => $x_points[$i], "y" => $y_points[$i]));
			array_push($p, array("x" => $x_points[$i + 1], "y" => $y_points[$i + 1]));
			array_push($p, array("x" => $x_points[min($i + 2, count($x_points) - 1)], "y" => $y_points[min($i + 2, count($y_points) - 1)]));
			// Catmull-Rom to Cubic Bezier conversion matrix
			//    0       1       0       0
			//  -1/6      1      1/6      0
			//    0      1/6      1     -1/6
			//    0       0       1       0

			$bp = array();
			array_push($bp, array("x" => ((-$p[0]["x"] + 6 * $p[1]["x"] + $p[2]["x"]) / 6), "y" => ((-$p[0]["y"] + 6 * $p[1]["y"] + $p[2]["y"]) / 6)));
			array_push($bp, array("x" => (($p[1]["x"] + 6 * $p[2]["x"] - $p[3]["x"]) / 6), "y" => (($p[1]["y"] + 6 * $p[2]["y"] - $p[3]["y"]) / 6)));
			array_push($bp, array("x" => $p[2]["x"], "y" => $p[2]["y"]));

			array_push($result, $bp);
		}

		return $result;
	}

	public function pathStart($x1, $y1, $px1, $py1, $px2, $py2, $x2, $y2)
	{
		return "M".$x1.",".$y1." C".$px1.",".$py1." ".$px2.",".$py2." ".$x2.",".$y2." ";
	}

	public function path($px1, $py1, $px2, $py2, $x2, $y2)
	{
		return "C".$px1.",".$py1." ".$px2.",".$py2." ".$x2.",".$y2." ";
	}

	public function computeControlPoints($K)
	{
		$p1 = array();
		$p2 = array();
		$n = count($K)-1;

		//rhs vector
		$a = array();
		$b = array();
		$c = array();
		$r = array();

		//left most segment
		$a[0] = 0;
		$b[0] = 2;
		$c[0] = 1;
		$r[0] = $K[0] + 2 * $K[1];

		//internal segments
		for ($i = 1; $i < $n - 1; $i++)
		{
			$a[$i] = 1;
			$b[$i] = 4;
			$c[$i] = 1;
			$r[$i] = 4 * $K[$i] + 2 * $K[$i + 1];
		}

		//right segment
		$a[$n - 1] = 2;
		$b[$n - 1] = 7;
		$c[$n - 1] = 0;
		$r[$n - 1] = 8 * $K[$n - 1] + $K[$n];

		//solves Ax=b with the Thomas algorithm (from Wikipedia)
		for ($i = 1; $i < $n; $i++)
		{
			$m = $a[$i] / $b[$i - 1];
			$b[$i] = $b[$i] - $m * $c[$i - 1];
			$r[$i] = $r[$i] - $m * $r[$i - 1];
		}
 
		$p1[$n - 1] = $r[$n - 1] / $b[$n - 1];
		for ($i = $n - 2; $i >= 0; --$i)
			$p1[$i] = ($r[$i] - $c[$i] * $p1[$i + 1]) / $b[$i];

		//we have p1, now compute p2
		for ($i = 0; $i < $n - 1; $i++)
			$p2[$i] = 2 * $K[$i + 1] - $p1[$i + 1];

		$p2[$n - 1] = 0.5 * ($K[$n] + $p1[$n - 1]);

		$result = array();
		array_push($result, $p1);
		array_push($result, $p2);
		return $result;
}

	// build water
	public function water($type, $y_line, $wl)
	{
		$y_range = $this->_range("y", $y_line);
		$level = $this->limit("height", $y_range[0], $y_range[1], $wl);

		if ( $type == "build" )
		{
			$point =		$this->x_bottomLeft.','.$this->y_bottomLeft.' '.
							$this->x_bottomLeft.','.$level.' '.
							$this->x_bottomRight.','.$level.' '.
							$this->x_bottomRight.','.$this->y_bottomRight;

			$temp = "<polygon points=\"".$point."\" style=\"fill: ".$this->color_blue."\" />\n";
		}
		else if ( $type == "value" )
		{
			$point =		'48,'.($level-2).' '.
							'50,'.$level.' '.
							'52,'.($level-2);

			$temp = "<polygon points=\"".$point."\" style=\"fill: ".$this->color_blue."\" />\n";
			$temp .= "<text x=\"50\" y=\"".$level."\" dy=\"-3\" fill=\"".$this->color_blue."\" font-size=\"".$this->font_size."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\">".$wl."</text>\n";
		}
		else
		{
			$temp = null;
		}

		return $temp;
	}
	

	// guide line
	public function guideLine($line, $level, $color, $pad_x, $pad_y, $text)
	{
		$range = $this->_range("y", $line);
		$level = $this->limit("height", $range[0], $range[1], $level);
	
		$temp = "<line x1=\"".$this->x_bottomLeft."\" y1=\"".$level."\" x2=\"".$this->x_bottomRight."\" y2=\"".$level."\" style=\"stroke: ".$color."; stroke-width: ".$this->line_min."\" />\n";
		$temp .= "<text x=\"".$this->x_bottomRight."\" y=\"".$level."\" dx=\"".$pad_x."\" dy=\"".$pad_y."\" font-size=\"".$this->font_min."\"  fill=\"".$this->color_black."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\">".$text."</text>\n";

		return $temp;
	}


	// guide text
	public function guideText($line, $level, $float, $pad, $text)
	{
		$range = $this->_range("y", $line);
		$h = $this->limit("height", $range[0], $range[1], $level);

		$temp .= "<text x=\"".$float."\" y=\"".$h."\" dx=\"".$pad."\" dy=\"-2\" font-size=\"".$this->font_min."\" fill=\"".$this->color_black."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\">".$text." ".$level."</text>\n";

		return $temp;
	}


	// limit
	private function limit($type, $min, $max, $val)
	{		
		if ( $val < $min )
		{
			$a = $min;
		}
		else if ( $val > $max )
		{
			$a = $max;
		}
		else
		{
			$a = $val;
		}

		$v1 = ( $a - $min ) / ( $max - $min ); 

		if ( $type == "width" )
		{
			$v2 = $this->x_bottomLeft + ( $v1 * ( $this->x_bottomRight - $this->x_bottomLeft ) );
		}
		else if ( $type == "height" )
		{
			$v2 = $this->y_bottomLeft - ( $v1 * ( $this->y_bottomLeft - $this->y_topLeft ) );
		}
		else
		{
			$v2 = 0;
		}

		return $v2;
	}




	// set axis X
	private function axisX($x_line)
	{		
		// line
		$line = "<line x1=\"".$this->x_bottomLeft."\" y1=\"".$this->y_bottomLeft."\" x2=\"".$this->x_bottomRight."\" y2=\"".$this->y_bottomRight."\" style=\"stroke: ".$this->color_black."; stroke-width: ".$this->line_width."\" />\n";

		// text
		$text = "<g font-size=\"".$this->font_size."\" fill=\"".$this->color_black."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\">\n";
		
		// cal
		$range = $this->_range("x", $x_line);
		$min = $range[0];
		$num = $range[2];
		$space = $range[3];
		$width = ( $this->x_bottomRight - $this->x_bottomLeft ) / $num;

		for ( $i = 0; $i <= $num; $i++ )
		{
			$x = $this->x_bottomLeft + ( $i * $width );
			$y = $this->y_bottomLeft;
			$v = $min + ( $i * $space );
			
			$text .= "<line x1=\"".$x."\" y1=\"".$y."\" x2=\"".$x."\" y2=\"".( $y + 1 )."\" style=\"stroke: ".$this->color_black."; stroke-width: ".$this->line_width."\" />\n";
			$text .= "<text x=\"".$x."\" y=\"".$y."\" dy=\"5\">".$v."</text>\n";
		}
	
		//$text .= "<TEXT x='".$x."' y='".$y."' dx='8' dy='8'>".($range[1]-$range[0])."</TEXT>\n";
		$text .= "</g>\n";
		
		$text .= "<text font-size=\"".$this->font_size."\" fill=\"".$this->color_brown."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\" x=\"50\" y=\"95\">Distance : m.</text>\n";


		return $line.$text;
	}


	// set axis Y
	private function axisY($y_line)
	{		
		// line
		$line = "<line x1=\"".$this->x_topLeft."\" y1=\"".$this->y_topLeft."\" x2=\"".$this->x_bottomLeft."\" y2=\"".$this->y_bottomLeft."\" style=\"stroke: ".$this->color_black."; stroke-width: ".$this->line_width."\" />\n";

		// text
		$text = "<g font-size=\"".$this->font_size."\" fill=\"".$this->color_black."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\">\n";
		
		// calc
		$range = $this->_range("y", $y_line);
		$min = $range[0];
		$num = $range[2];
		$space = $range[3];				
		$height = ( $this->y_bottomLeft - $this->y_topLeft ) / $num;

		for ( $i = 0; $i <= $num; $i++ )
		{
			$x = $this->x_bottomLeft;
			$y = $this->y_bottomLeft - ( $i * $height );
			//$v = $min + ( $i * $this->y_num );
			$v = $min + ( $i * $space );
			
			$text .= "<line x1=\"".$x."\" y1=\"".$y."\" x2=\"".( $x - 1 )."\" y2=\"".$y."\" style=\"stroke: ".$this->color_black."; stroke-width: ".$this->line_width."\" />\n";
			$text .= "<text x=\"".$x."\" y=\"".$y."\" dx=\"-4\" dy=\"1\">".$v."</text>\n";
		}
		
		//$text .= "<TEXT x='".$x."' y='".$y."' dx='-5' dy='-3'>".$range[1]."</TEXT>\n";
		$text .= "</g>\n";
		
		$text .= "<text font-size=\"".$this->font_size."\" fill=\"".$this->color_brown."\" stroke=\"none\" text-anchor=\"".$this->font_anchor."\" x=\"-50\" y=\"5\" transform=\"rotate(-90)\">Level : m.(MSL.)</text>\n";


		return $line.$text;
	}




	// calc point
	private function _range($type, $line)
	{
		$_min = min($line);
		$_max = max($line);

		if ( $type == "x" )
		{
			$min_1 = $this->x_minimum;
			$min_2 = floor( $min_1 / 2 );
			$min_3 = floor( $min_2 / 2 );
			$min_4 = ceil( $min_3 / 2 * 0.1 ) * 10;
			$min_5 = -5;
			$min_cp = $min_2 + $min_3;
			
			// min
			if ( $_min < 0 )
			{
				if ( $_min >= $min_5 )
				{
					$min = $min_5;
				}
				else if ( $_min >= $min_4 )
				{
					$min = $min_4;
				}
				else if ( $_min >= $min_3 )
				{
					$min = $min_3;
				}
				else if ( $_min >= $min_2 )
				{
					$min = $min_2;
				}
				else if ( $_min >= $min_cp )
				{
					$min = $min_2;
				}
				else
				{
					$min = $min_1;
				}
			}
			else
			{
				$min = 0;
			}
			
			$num = $this->x_num;
			$diff = $_max - $_min;
			$space = ( $diff >= 100 ) ? floor( round($diff, -2) / 4 ) : 10;
			$space = ( $diff < 40 ) ? 5 : $space;
			$max = $min + ( $num * $space );
		}
		else if ( $type == "y" ) 
		{
			//$min = floor($_min) - 1;
			//$space = ceil( ( ( floor($_max) + 2 ) - $min ) / $num );
			$num = $this->y_num;
			$space = $this->y_minimum;
			$r = round($_min * 0.1) * 10;
			$v = ( $r > $_min ) ? $r - 5 : $r;
			$min = ( (floor($_min) - $v) < 1 ) ? $v - 5 : $v;
			$max = $min + ( $num * $space );
		}
		else
		{
			$min = 0;
			$max = 0;
			$num = 0;
			$space = 0;
		}
		
		return array($min, $max, $num, $space);
	}


	// set line
	public function line($type, $id)
	{
		$filename = $this->file_path.$id.$this->file_type;
		
		if ( file_exists($filename) )
		{
			$lines = file($filename, FILE_IGNORE_NEW_LINES);
			$x = explode(",", preg_replace('/\s+/', '', $lines[0]));
			$y = explode(",", preg_replace('/\s+/', '', $lines[1]));
		}
		else
		{
			$x = array(0, 0, 90, 90);
			$y = array(10, 10, 10, 10);
		}

		if ( $type == "x" )
		{
			return $x;
		}
		else if ( $type == "y" )
		{
			return $y;
		}
		else
		{
			return false;
		}
	}

}

$call_svg = new SVG();
$call_svg->crossSection($_GET['id'], $_GET['wl'], $_GET['lv1'], $_GET['lv2'], $_GET['bm'], $_GET['zg'], $_GET['bd'], $_GET['left'], $_GET['right']);
?>