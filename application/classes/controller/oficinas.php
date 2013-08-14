<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_oficinas extends Controller_Minitemplate{
    public $lista='';
    public function action_index(){
        $entidades=ORM::factory('entidades')->find_all();
        
    }
    
    
    
    
    
    //action para adicionar una nueva oficina
   public function action_add()
    {
       $auth =Auth::instance();
       if($auth->logged_in())
               {
           $user=ORM::factory('users',$auth->get_user());
            if($user->nivel==3) //nivel 3 administrador del sistema
            {
                 $oficinas=ORM::factory('oficinas')->find_all();
                 $options=array(''=>'Seleccione oficina...');
                 foreach ($oficinas as $o){
                     $options[$o->id]=$o->nombre;
                 }
                 $this->template->menu   =View::factory('admin/menu');
                 $this->template->content=View::factory('oficina/add')
                                          ->bind('options', $options)
                                          ->bind('message', $message);
              if ($_POST)
                {
                try {
                    $verificar_sigla=  ORM::factory('oficinas')->where('sigla','=',trim($_POST['sigla']))->find_all();
                    if(sizeof($verificar_sigla)>0){ $message = "La Oficina con sigla '{$_POST['sigla']}' ya esta registrada!!!"; }
                    else{
                    // Create the user using form values
                    $oficina = ORM::factory('oficinas');
                    $oficina->padre=$_POST['padre'];
                    $oficina->nombre=trim($_POST['nombre']);
                    $oficina->sigla=trim($_POST['sigla']);
                    $oficina->save();
                    $_POST = array();
                    // Set success message
                    $message = "Tu registraste a '{$oficina->nombre}' como nueva oficina";
                    }
                    } catch (ORM_Validation_Exception $e) {
                    // Set failure message
                    $message = 'There were errors, please see form below.';
                    // Set errors using custom messages
                    $errors = $e->errors('models');
                     }
                } //fin if POST
            }
            else
             {
             $this->template->content=View::factory('errors/user');
             }  
       }
   }
   public function action_lista(){
                  
           $this->lista='<ul id="oficina">';
           // echo '<ul>';
            
            $this->listar(5,'Despacho Ministerial','MDPyEP');
         //   echo '</ul>';
            $this->lista.='</ul>';
            $config=array();
            //$config=  ORM::factory('configuracion',1);
            $this->template->menu=  View::factory('admin/menu');
            $this->template->content   = View::factory('oficina/lista')
                                        ->bind('lista', $this->lista)
                                        ->bind('config', $config);
       }
   
   
   public function listar($id,$oficina,$sigla){
       $h=ORM::factory('oficinas')->where('padre','=',$id)->count_all();              
       //echo '<li>'.$oficina;       
	   $this->lista.='<li class="oficina">'.HTML::anchor('admin/user/lista/'.$id,$oficina.' | '.$sigla);
       if($h>0){
       //echo '<ul>';
       $this->lista.='<ul>';
       $hijos=ORM::factory('oficinas')->where('padre','=',$id)->find_all();
        foreach($hijos as $hijo){
                  $oficina=$hijo->oficina;
                  $this->listar($hijo->id,$oficina,$hijo->sigla);
         }
         $this->lista.='</ul>';
       // echo '</ul>';
       }
        else{
            $this->lista.='</li>';
         //   echo '</li>';
        }
   }
   public function action_list($id=''){
            $user=  ORM::factory('users',$auth->get_user());
            if($user->nivel==3){
            $oficina=  ORM::factory('oficinas',$id);
            $usuarios=ORM::factory('users')->where('id_oficina','=',$id)->find_all();
            $this->template->menu=  View::factory('admin/menu');
            $this->template->content=View::factory('user/list')->bind('usuarios', $usuarios)
                ->bind('oficina', $oficina);
            }
            else{
                $this->template->content=View::factory('errors/user');
            }
        
    }
    public function action_pdf($id){
        $auth=Auth::instance();
        if($auth->logged_in()){
            $documento=ORM::factory('documentos',$id);  
            echo $documento->fecha;
            require_once ('tcpdf/config/lang/spa.php');
            require_once ('tcpdf/tcpdf.php');
  
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// create new PDF document
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content

$html = '<h2>HTML TABLE:</h2>
<table border="1" cellspacing="3" cellpadding="4">
	<tr>
		<th>#</th>
		<th align="right">RIGHT align</th>
		<th align="left">LEFT align</th>
		<th>4A</th>
	</tr>
	<tr>
		<td>1</td>
		<td bgcolor="#cccccc" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
		<td>4B</td>
	</tr>
	<tr>
		<td>ss</td>
		<td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
		<td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
		<td>4C</td>
	</tr>
	<tr>
		<td>1A</td>
		<td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
		<td bgcolor="#FF0000">4D</td>
	</tr>
	<tr>
		<td>1B</td>
		<td>4E</td>
	</tr>
	<tr>
		<td>1C</td>
		<td>2C</td>
		<td>3C</td>
		<td>4F</td>
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_0066.pdf', 'I');
        }
    }
}
?>
