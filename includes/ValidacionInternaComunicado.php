<?php

define('MH_BADWORDS','sexo,porno,pornografia,pornografica,xxx,desnudar,desnudo,desnuda,culear,culea,culeo,puta,puto,marica,gay,teta,pipi,picha,monda,verga,chucha,chocho,orto,culo,trola,marica,colla,hijodeputa,hijueputa,maricon,vergon,chuchon,pendejo,pendeja,imbecil,idiota,pija,nalga,mierda,caga,cagon,cagona,pelotudo,pelotuda,boluda,boludo,mamar,mamaron,perra,tarado,bobo,tonto,tarada,boba,tonta,careverga,caremonda,giripolla,gilipolla,gonorrea,cojon,ano,estupido,estupida,poronga,feo,fea,perdedor,perdedora,maldito,maldita,pene,cerote,fuck');

define('MH_GRINGAS_K','kiss,nokia,pokemon,katy,take,karspesky,kelly,keane,ke$ha,kesha,kid,drake,nike,ksanchez');

define('MH_GRINGAS_DOBLE','twitter,kiss,rihanna,message,messenger,wordpress,blogger,full,hanna,madonna,look,leer,creer,cree,facebook,google,good,badoo,book,cool,foo,teen,see,queen,apple,notebook,ericsson,green,free,office,app,blood,dell,battle,emma,potter,harry,bell,http,messi,www,att');

define('MH_GRINGAS_S_T','get,cat,that,best,post,net,chat,studio,spear,speaker,microsoft,tablets,internet,steven,spears,hot,spanish,storm,special,studio,foxit,avast,stone');

define('MH_STOPWORDS','el,la,los,les,las,de,del,a,ante,con,en,para,por,e,o,u,tu,te,ti,le,que,al,ha,he,un,han,lo,su,una,estas,esto,este,es,tras,aca,ahi,al,algo,algun,alguna,algunas,alguno,algunos,alla,alli,antes,aquel,aquella,aquellas,aquello,aquellos,aqui,asi,atras,aun,aunque,bajo,bastante,bien,bieber,cabe,cada,casi,cierta,ciertas,cierto,ciertos,como,con,conmigo,conseguimos,conseguir,consigo,consigue,consiguen,consigues,contigo,contra,cual,cuales,cualquier,cualquiera,cualquieras,cuando,cuanta,cuantas,cuanto,cuantos,de,dejar,del,demas,demasiada,demasiadas,demasiado,demasiados,dentro,desde,donde,dos,el,ella,ellas,ello,ellos,en,encima,entonces,entre,era,eramos,eran,eras,eres,es,esa,esas,ese,eso,esos,esta,estaba,estado,estais,estamos,estan,estar,estas,este,esto,estos,estoy,etc,fin,fue,fueron,fui,fuimos,gueno,haber,hace,haceis,hacemos,hacen,hacer,haces,hacia,haga,hagan,hago,hasta,hola,hoygan,hoygans,hice,hizo,incluso,intenta,intentais,intentamos,intentan,intentar,intentas,intento,ir,jamas,junto,juntos,la,largo,las,lo,los,mas,me,menos,mi,mia,mias,mientras,mio,mios,mis,misma,mismas,mismo,mismos,modo,mucha,muchas,muchisima,muchisimas,muchisimo,muchisimos,mucho,muchos,muy,nada,ni,ningun,ninguna,ningunas,ninguno,ningunos,no,nos,nosotras,nosotros,nuestra,nuestras,nuestro,nuestros,nunca,os,otra,otras,otro,otros,para,parecer,pero,poca,pocas,poco,pocos,podeis,podemos,poder,podria,podriais,podriamos,podrian,podrias,por,porque,primero,puede,pueden,puedo,pues,que,querer,quien,quienes,quiera,quienquiera,quiza,quizas,sabe,sabeis,sabemos,saben,saber,sabes,se,segun,ser,si,siempre,siendo,sin,sino,so,sobre,sois,solamente,solo,somos,soy,sr,sra,sres,esta,su,sus,suya,suyas,suyo,suyos,tal,tales,tambien,tampoco,tan,tanta,tantas,tanto,tantos,te,teneis,tenemos,tener,tengo,ti,tiempo,tiene,tienen,toda,todas,todo,todos,tras,tu,tus,tuya,tuyo,tuyos,ultimo,un,una,unas,uno,unos,usa,usais,usamos,usan,usar,usas,uso,usted,ustedes,va,vais,vamos,van,varias,varios,vaya,verdad,verdadera,vosotras,vosotros,voy,vuestra,vuestras,vuestro,vuestros,y,ya,yo');

register_activation_hook(__file__,'mh_admin_activation');
register_deactivation_hook(__file__,'mh_admin_deactivation');

function mh_admin_activation()
{
 add_option('mh_HOYGAN', '1');
 add_option('mh_censura', '1');
 add_option('mh_SEO', '1');

 add_option('mh_palabras_censuradas', MH_BADWORDS );
 
 add_option('mh_no_corregir_doble', MH_GRINGAS_DOBLE );
 add_option('mh_no_corregir_k', MH_GRINGAS_K );
 add_option('mh_no_corregir_s_t', MH_GRINGAS_S_T );

 add_option('mh_ultimo_comentario', '0');
 add_option('mh_terminado', '0');

}

function mh_admin_deactivation()
{
 delete_option('mh_HOYGAN');
 delete_option('mh_censura');
 delete_option('mh_SEO');


 delete_option('mh_palabras_censuradas');
 delete_option('mh_no_corregir_doble');
 delete_option('mh_no_corregir_k');
 delete_option('mh_no_corregir_s_t');
 delete_option('mh_ultimo_comentario');
 delete_option('terminado');

 delete_option('mensaje_ocultado');
}

function mh_admin_update_options()
{
 update_option( 'mh_HOYGAN', $_POST['HOYGAN'] );
 update_option ( 'mh_censura', $_POST['Censura'] );
 update_option ( 'mh_SEO', $_POST['SEO'] );

 update_option ( 'mh_palabras_censuradas', trim( $_POST['palabras_censuradas'], ' ,.' ) );
 update_option ( 'mh_no_corregir_doble', trim( $_POST['no_corregir_doble'], ' ,.' ) );
 update_option ( 'mh_no_corregir_k', trim( $_POST['no_corregir_k'], ' ,.' ) );
 update_option ( 'mh_no_corregir_s_t', trim( $_POST['no_corregir_s_t'], ' ,.' ) );
 ?>
  <div id="message" class="updated fade">
   <p>Cambios Grabados</p>
  </div>
 <?php
}

function mh_admin_print_title()
{
 ?>
 <style type="text/css">
  .mh-table{ margin: 14px; }
  .mh-table tr{ height: 28px; }
  .inside p{ margin: 14px; }
  .inside .frame { margin: 10px; }
  .inside .list li { font-size: 11px; }
 </style>
 <div class = "wrap">
  <h2>SIGOES-validación</h2>
 <?php 
}

function mh_admin_print_header()
{
 ?>
 <div>
  <p><strong>IMPORTANTE</strong>: Los campos llamados "Excepciones" son para agregar las palabras que estan bien escritas pero que por uno u otro motivo el Plugin las toma como palabras HOYGANS y trata de transformarlas, un ejemplo son algunas palabras en ingles como: Good, Twitter, Market, Special, etc.
Si ves que alguna palabra que esta bien escrita es transformada debes agregarla a los campos "Excepciones".</p>
<p><strong>Excepciones con repetición de letras</strong>: En este campo agregamos las palabras que tienen 2 letras iguales juntas, ejemplo: Google, Badoo, Twitter.</p>
<p><strong>Excepciones palabras con K</strong>: En este campo agregamos las palabras que tienen la letra "K", ejemplo: Kelly, Pokemon.</p>
<p>El Plugin reconoce automaticamente algunas <strong>palabras con K en Ingles</strong> para que no pierdas tu tiempo agregando palabras con "K" a las Excepciones.</p>
<p>Las palabras en Ingles reconocidas siguen estos patrones:</p>
<ul>
<li>1. Si la palabra tiene "ck", "nk" o "ky", Ejemplo: Chicken, Skype, Funky.</li>
<li>2. Si la palabra termina en "k", "ks", "king", "ked", "kes", "kies", "ker", "ki", Ejemplo: Book, Books, Looking, Marked, Cakes, Mckies, Maker.</li>
<li>3. Si la palabra inicia con "kn", Ejemplo: Know.</li>
<ul/>

<p><strong>Excepciones palabras terminan con T y empiezan con SP o ST</strong>: En este campo agregamos las palabras que terminan con "T" y empiezan con "SP" o "ST".</p>
 </div>
 <?php
}

function mh_admin_explicacion()
{
 ?>
 <table>
  <tr>
   <td>
    <p>No es necesarios agregar palabras con alguna de las siguientes terminaciones:</p>
    <p>s - n - na - da - es - as - on - an - te - mos - nes - nas - das - ada - ndo - emos - adas</p>
    <p>Por ejemplo con solo agregar la palabra Cerdo serán censuradas:</p>
    <p>Cerdo, Cerdos, Cerdon, Cerdones, Cerdonas</p>
   </td>
  </tr>
  <tr>
   <td>
    <p>Tampoco es necesarios agregar palabras en Ingles con alguna de las siguientes terminaciones:</p>
    <p>s - ing - ed - es - ies</p>
    <p>Por ejemplo con solo agregar la palabra Fuck serán censuradas:</p>
    <p>Fucks, Fucking, Fucked, Fuckies, Fuckes (Aunque las 2 ultimas no existen en Ingles</p>
   </td>
  </tr>
 </table>
 <?php
}

function mh_admin_print_admin_page()
{
 $badwords = get_option('mh_palabras_censuradas');
 if ( empty($badwords) )
 {
  $badwords = MH_BADWORDS;
  update_option ( 'mh_palabras_censuradas', trim( $badwords,' ,.' ) );	
 }

 $palabras_otro_idioma_doble = get_option('mh_no_corregir_doble');
 if ( empty($palabras_otro_idioma_doble) )
 {
  $palabras_otro_idioma_doble = MH_GRINGAS_DOBLE;
  update_option ( 'mh_no_corregir_doble', trim( $palabras_otro_idioma_doble,' ,.' ) );	
 }

 $palabras_otro_idioma_k = get_option('mh_no_corregir_k');
 if ( empty($palabras_otro_idioma_k) )
 {
  $palabras_otro_idioma_k = MH_GRINGAS_K;
  update_option ( 'mh_no_corregir_k', trim( $palabras_otro_idioma_k,' ,.' ) );	
 }

 $palabras_otro_idioma_s_t = get_option('mh_no_corregir_s_t');
 if ( empty($palabras_otro_idioma_s_t) )
 {
  $palabras_otro_idioma_s_t = MH_GRINGAS_S_T;
  update_option ( 'mh_no_corregir_s_t', trim( $palabras_otro_idioma_s_t,' ,.' ) );	
 }

 ?>
 <div class="postbox-container" style="width: 65%;">
  <div class="metabox-holder">
   <div class="meta-box-sortables ui-sortable">
    <div id="mh-opciones" class="postbox">
     <div class="handlediv" title="Click to toggle"><br/></div>
     <h3 class="hndle">
      <span>Opciones generales:</span>
     </h3>
     <div class="inside">
      <div class="frame list">
       <form id="mh-options" method="post" action="">
        <table class="mh-table">
         <tr>
          <td width="450px">
           <label>Corregir Lenguaje HOYGAN:</label>
          </td>
          <td>
	   <input type="checkbox" <?php if( 1 == get_option('mh_HOYGAN') ){ echo 'checked'; }; ?> value="1" name="HOYGAN"/>
          </td>
	 </tr>
	 <tr>
	  <td width="450px">
           <label>Censurar palabras:</label>
          </td>
          <td>
	   <input type="checkbox" <?php if( 1 == get_option('mh_censura') ){ echo 'checked'; }; ?> value="1" name="Censura"/>
          </td>
	 </tr>
	 </tr>
         <tr>
          <td width="450px">
           <label>Resaltar palabras claves:</label>
          </td>
          <td>
	   <input type="checkbox" <?php if( 1 == get_option('mh_SEO') ){ echo 'checked'; }; ?> value="1" name="SEO"/><label> Funciona solo si usas <strong>All in ONE SEO</strong> en el Blog</label>
          </td>
	 </tr>

	 <tr>
          <td valign="top" style="padding-top:10px;">
           <label>Censurar las siguientes Palabras:</label>
          </td>
          <td>
	   <textarea name = "palabras_censuradas" cols="50" rows="3"><?php echo $badwords; ?></textarea>
          </td>
	 </tr>

	 <tr>
          <td valign="top" style="padding-top:10px;">
           <label>Excepciones con repeticion de letras:</label>
          </td>
          <td>
	   <textarea name = "no_corregir_doble" cols="50" rows="3"><?php echo $palabras_otro_idioma_doble; ?></textarea>
          </td>
	 </tr>

	 <tr>
          <td valign="top" style="padding-top:10px;">
           <label>Excepciones palabras con K:</label>
          </td>
          <td>
	   <textarea name = "no_corregir_k" cols="50" rows="3"><?php echo $palabras_otro_idioma_k; ?></textarea>
          </td>
	 </tr>

	 <tr>
          <td valign="top" style="padding-top:10px;">
           <label>Excepciones palabras terminan con T y empiezan con SP o ST:</label>
          </td>
          <td>
	   <textarea name = "no_corregir_s_t" cols="50" rows="3"><?php echo $palabras_otro_idioma_s_t; ?></textarea>
          </td>
	 </tr>

	 <tr>
   	  <td>
           <br />
           <span class="submit" style="margin-top:14px;">
            <input class="button-primary" type = "submit" name="submit" value="Grabar Cambios" />
           </span>
	  </td>
          <?php 
           if (is_admin())
           {
          ?>
   	  <td>
           <br />
           <span class="submit" style="margin-top:14px;">
            <input class="button-primary" type = "submit" name="submit2" value="Transformar Comentarios viejos" />
           </span>
	  </td>
          <?php 
           }
          ?>
	 </tr>
	</table>
       </form>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div class="postbox-container" style="width: 30%;">
  <div class="metabox-holder">
   <div class="meta-box-sortables ui-sortable">
    <div id="mh_explicacion" class="postbox">
     <div class="handlediv" title="Click to toggle"></div>
     <h3 class="hndle">
      <span>Explicación sobre palabras a Censurar:</span>
     </h3>
     <div class="inside">
      <div class="frame list">
       <?php echo mh_admin_explicacion(); ?>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <?php 
}

function mh_create_admin_menu()
{
 mh_admin_print_title();
 mh_admin_print_header();
 if (isset($_POST['submit']))
 {
  mh_admin_update_options();
 }
 if (isset($_POST['submit2']))
 {
  update_option ('mh_ultimo_comentario', '0');
  update_option ('mh_terminado', '1');
  ?>
   <div id="message" class="updated fade">
    <p>Transformando Comentarios Viejos</p>
   </div>
  <?php
  deshoyganizar_comentarios_viejos();
  update_option ('mh_terminado', '0');
 }

 mh_admin_print_admin_page();
}
	
function mh_admin_menu_hook()
{
 if (function_exists('add_options_page'))
 {
 add_options_page('Validación','Validación','manage_options','validacion','mh_create_admin_menu');
 //Con la siguiente opcion se puede integrar al menu de proyecto atraves del slug de CTP
 //add_submenu_page( 'edit.php?post_type=proyecto','Validación','Validación','manage_options','validacion','mh_create_admin_menu'); 
 }
}
add_action('admin_menu','mh_admin_menu_hook');
/*Busca la posicion donde se encontro coincidencia de la cadena*/
function stringrpos($haystack,$needle,$offset=NULL)
{
 return strlen($haystack) - strpos( strrev($haystack) , strrev($needle) , $offset) - strlen($needle);
}
/*Reemplaza los elementos dentro del string por codigo html*/
function tohtml($text)
{
 $text = str_replace("<", "&lt;", $text);
 $text = str_replace(">", "&gt;", $text);
 $text = str_replace("\r\n", "</br>", $text);
 return $text;
}
/*Verifica que la url este dentro del formato permitido*/
function is_url($url)
{
 $patron = "/((\s+(http[s]?:\/\/)|(www\.))?(([a-z][-a-z0-9]+\.)?[a-z][-a-z0-9]+\.(([a-zA-Z]{2}|aero|asia|biz|cat|com|co|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|es|tk)(\.[a-z]{2,2})?))\/?[a-z0-9._\/~#&=;%+?-]+[a-z0-9\/#=?]{1,1})/is";
 if(preg_match($patron, $url))
  return true;
 else
 return false;
}
/*Reemplaza varios simbolos dentro de la cadena*/
function dessimbolizar($text)
{
 $text = str_replace("@", "a", $text);
 $text = str_replace("ª", "a", $text);
 $text = str_replace("º", "o", $text);
 $text = str_replace(" = "," igual ",$text);
 $text = preg_replace("/(\w*?)!(\w)/","\\1i\\2",$text);
 $text = preg_replace("/(\w+?)¡/","\\1i",$text);
 return $text;
}

function es_numero_o_referencia($text)
{
 // si comienza en numero y termina en numero "123"
 if (preg_match("/^\d+$/",$text))
  return 1;

 // si comienza en cualquier caracter que no sea numero y termina en numero "F30" "$10"
 else if (preg_match("/^\D+(\d)+$/",$text))
  return 1;

 // si comienza en numero y termina en cualquier caracter que no sea numero "10a" "10?"
 else if (preg_match("/^\d+(\D)+$/",$text))
  return 1;

 // si comienza en numero, continua con un caracter de puntuacion y termina en numero "123.456" "100,001"
 else if (preg_match("/^\d+([[:punct:]])+(\d)+$/",$text))
  return 1;

 // si comienza en en cualquier caracter que no sea numero, continua con un numero, continua con un caracter de puntuacion y termina en numero "A123.456" "$100,001"
 else if (preg_match("/^\D+(\d)+([[:punct:]])+(\d)+$/",$text))
  return 1;

 // si comienza en en cualquier caracter que no sea numero, continua con un numero, continua con un caracter de puntuacion y termina en numero "123.456?" "100,001$"
 else if (preg_match("/^(\d)+([[:punct:]])+(\d)+\D+$/",$text))
  return 1;

 else 
  return 0;
}

function deleet($text)
{
 if (!preg_match("/\b\d+\b/",$text))
 {
  $text = str_replace("0", "o", $text);
  $text = str_replace("1", "i", $text);
  $text = str_replace("3", "e", $text);
  $text = str_replace("4", "a", $text);
  $text = str_replace("5", "s", $text);
  $text = str_replace("7", "t", $text);
 }
 return $text;
}

function desalternar($word)
{
 if (strlen($word) > 1 and !(ctype_upper($word[0]) and ctype_lower(substr($word,1))))
 {
  return strtolower($word);
 }
 else
  return $word;
}

function desmultiplicar($word)
{
 $exceptions = array('http','www','://', 'ss', 'ppio', 'ff', 'bb', 'proteccion', 'cree', 'crees', 'creer', 'creen', 'creencia', 'creencias', 'creemos', 'direccion', 'zoo','lee','leen','leer','leera','leeras','leere','leemos');
 $lword = strtolower($word);

 if (preg_match("/^bs[s]+$/",$lword))
 {
  return 'besos';
 }
 if (preg_match("/^mm[m]+[h]*$/",$lword))
 {
  return 'mmmh';
 }
 if (preg_match("/^aa[a]+[h]*$/",$lword))
 {
  return 'aaah';
 }
 if (preg_match("/^ba[a]+[h]*$/",$lword))
 {
  return 'baaah';
 }
 if (preg_match("/^bu[u]+[h]*$/",$lword))
 {
  return 'buuu';
 }

 $palabras_gringas = get_option('mh_no_corregir_doble');
 $palabras=explode(",",$palabras_gringas);
 $todo_bien=0;
 foreach ($palabras as $palabra)
 {
  if (strcasecmp($palabra, $lword) == 0)
  {
   $todo_bien=1;
   break;
  }
  else
  {
   if (stristr($lword, $palabra) == TRUE)
   {
    if (preg_match("/[^\wñÑáéíóúÁÉÍÓÚ$]/",$lword))
     $word = preg_replace("/([[:punct:]])\\1+/","\\1",$lword);

    $todo_bien=1;
    break;
   }
  }
 }

 if($todo_bien==0)
 {
  if (!in_array($lword, $exceptions))
  {
   if (preg_match("/(^|[^l])[l][l]([^l])+/",$lword)&&preg_match("/(^|[^l])[l][l]([\w])+/",$lword))
   {
    $pos = stringrpos($lword,'ll');
    return desmultiplicar(substr($lword,0,$pos)).'ll'.desmultiplicar(substr($lword,$pos+2));
   }
   if (preg_match("/([^r])+[r][r]([^r])+/",$lword)&&preg_match("/([^r])+[r][r]([\w])+/",$lword))
   {
    $pos = stringrpos($lword,'rr');
    return desmultiplicar(substr($lword,0,$pos)).'rr'.desmultiplicar(substr($lword,$pos+2));
   }
   if (preg_match("/([^c])+[c][c]([^c])+/",$lword)&&preg_match("/([^c])+[c][c]([\w])+/",$lword))
   {
    $pos = stringrpos($lword,'cc');
    return desmultiplicar(substr($lword,0,$pos)).'cc'.desmultiplicar(substr($lword,$pos+2));
   }
   return preg_replace("/(.)\\1+/","\\1",$word);
  }
  else
  {
   return $word;
  }
 }
 else
 {
  return $word;
 }
}

function desms($word)
{
$translations = array(
                    '+' => 'más',
                    '+a' => 'masa',
                    'ad+' => 'además',
                    'a2' => 'adiós',
                    'ak' => 'acá',
                    'amis' => 'amigos/as',
                    'amix' => 'amigos/as',
                    'asc' => 'al salir de clase',
                    'asdc' => 'al salir de clase',
                    'bld' => 'boludo',
                    'blds' => 'boludos',
                    'bn' => 'bien',
                    'bno' => 'bueno',
                    'bss' => 'besos',
                    'c' => 'se',
                    'cdo' => 'cuando',
                    'cel' => 'celular',
                    'celu' => 'celular',
                    'clp' => 'chupame la pija',
                    'cmo' => 'como',
                    'd' => 'de',
                    'dle' => 'dale',
                    'dnd' => 'donde',
                    'dsd' => 'desde',
                    'dsp' => 'después',
                    'flia' => 'familia',
                    'fto' => 'foto',
                    'hdp' => 'hijo de puta',
                    'hexo' => 'hecho',
                    'hlqp' => 'hacemos lo que podemos',
                    'hna' => 'hermana',
                    'hno' => 'hermano',
                    'hsta' => 'hasta',
                    'k' => 'que',
                    'ke' => 'que',
                    'kpo' => 'capo',
                    'ksa' => 'casa',
                    'knto' => 'cuanto',
                    'lpm' => 'la puta madre',
                    'lpmqtp' => 'la puta madre que te parió',
                    'lpqtp' => 'la puta que te parió',
                    'm' => 'me',
                    'mjor' => 'mejor',
                    'mjr' => 'mejor',
                    'msj' => 'mensaje',
                    'mñn' => 'mañana',
                    'n' => 'en',
                    'na' => 'nada',
                    'nd' => 'nada',
                    'nxe' => 'noche',
                    'ns vms' => 'nos vemos',
                    'ns vms dsps' => 'nos vemos después',
                    'ns vms mñn' => 'nos vemos mañana',
                    'pa' => 'para',
                    'peli' => 'pelicula',
                    'pelis' => 'peliculas',
                    'pelix' => 'peliculas',
                    'ppio' => 'principio',
                    'pq' => 'porque',
                    'pork' => 'porque',
                    'porke' => 'porque',
                    'ps' => 'pues',
                    'pso' => 'paso',
                    'pt' => 'pete',
                    'q' => 'que',
                    'qn' => 'quien',
                    'qndo' => 'cuando',
                    'salu2' => 'saludos',
                    'ss' => 'sos',
                    'sta' => 'está',
                    'stan' => 'están',
                    'stamos' => 'estamos',
                    'stes' => 'estás',
                    'stoi' => 'estoy',
                    't' => 'te',
                    'tas' => 'estas',
                    'tb' => 'también',
                    'tbj' => 'trabajo',
                    'tbn' => 'también',
                    'tdo' => 'todo',
                    'tdos' => 'todos',
                    'tds' => 'todos',
                    'tgo' => 'tengo',
                    'tkm' => 'te quiero mucho',
                    'tmb' => 'también',
                    'tmbn' => 'también',
                    'tmp' => 'tampoco',
                    'tngo' => 'tengo',
                    'tp' => 'tampoco',
                    'toy' => 'estoy',
                    'tk' => 'te quiero',
                    'tkm' => 'te quiero mucho',
                    'tq' => 'te quiero',
                    'tqm' => 'te quiero mucho',
                    'vac' => 'vacaciones',
                    'vd' => 'verdad',
                    'vr' => 'ver',
                    'wenas' => 'buenas',
                    'way' => 'guay',
                    'x' => 'por',
                    'xa' => 'para',
                    'xat' => 'chat',
                    'xk' => 'porque',
                    'xke' => 'porque',
                    'xo' => 'abrazos y besos',
                    'xoxo' => 'pero',
                    'xq' => 'porque',
                    'xqe' => 'porque',
                    'zoo' => 'zoologico'
	);

 if (array_key_exists  ( strtolower($word)  , $translations  ))
 {
  return $translations[strtolower($word)];
 }
 else
 {
  $lword = strtolower($word);

  if (preg_match("/qe/",$lword) or preg_match("/qi/",$lword))
  {
   $lword = str_replace('qe', 'que', $lword);
   $lword = str_replace('qi', 'qui', $lword);
   $word = $lword;
  }

  if (strlen($lword) > 2 and $lword{strlen($lword)-1} == 'q')
  {
   $lword = substr($lword,0,-1)." que";
   $word = $lword;
  }

  if (strlen($lword) > 3 and substr($lword,-2) == 'ms')
  {
   $lword = substr($lword,0,-1)."os";
   $word = $lword;
  }
  
  if (strlen($lword) > 1 and substr($lword,0,2) == 'cn')
  {
   $lword = "con".substr($lword,2);
   $word = $lword;
  }

  if (strlen($lword) > 2 and substr($lword,0,3) == 'bso')
  {
   $lword = "be".substr($lword,1);
   $word = $lword;
  }
 
  if (strlen($lword) > 2 and substr($lword,0,3) == 'bld')
  {
   $lword = "bolu".substr($lword,2);
   $word = $lword;
  }
  
  if (strlen($lword) > 3 and substr($lword,0,4) == 'efea')
  {
   $lword = "agrega".substr($lword,4)." a favoritos";
   $word = $lword;
  }
 
  if (strlen($lword) > 4 and substr($lword,0,5) == 'efeen')
  {
   $lword = "agreguen".substr($lword,5)." a favoritos";
   $word = $lword;
  }
  
  if (strlen($lword) > 3 and substr($lword,0,3) == 'mux')
  {
   $lword = "much".substr($lword,3);
   $word = $lword;
  }

  return $word;
 }
}

function desestupidizar($word)
{
 $translations = array(
                    '1ro' => 'primero',
                    '100pre' => 'siempre',
                    'ai' => 'ahí/hay/ay',
                    'aios' => 'adiós',
                    'aga' => 'haga',
                    'agan' => 'hagan',
                    'aka' => 'acá',
                    'aki' => 'aquí',
                    'akí' => 'aquí',
                    'anio' => 'año',
                    'aver' => 'haber',
                    'bai' => 'bye',
                    'ben' => 'bien',
                    'bem' => 'bien',
                    'ber' => 'ver',
                    'bes' => 'vez',
                    'bibe' => 'vive',
                    'bista' => 'vista',
                    'bue' => 'bueno',
                    'bzo' => 'beso',
                    'clabe' => 'clave',
                    'dise' => 'dice',
                    'desir' => 'decir',
                    'doi' => 'doy',
                    'efe' => 'favorito',
                    'efeo' => 'agrego a mis favoritos',
                    'efen' => 'agreguen a favoritos',
                    'efes' => 'favoritos',
                    'efs' => 'favoritos',
                    'enbien' => 'envien',
                    'estoi' => 'estoy',
                    'ff' => 'favoritos',
                    'fs' => 'favoritos',
                    'grax'=> 'gracias',
                    'groxo'=> 'grosso',
                    'hai' => 'hay',
                    'hoi'=> 'hoy',
                    'hi' => 'y',
                    'i' => 'y',
                    'ia' => 'ya',
                    'io' => 'yo',
                    'ise' => 'hice',
                    'iwal' => 'igual',
                    'kmo' => 'como',
                    'kn' => 'con',
                    'oi' => 'hoy',
                    'moy' => 'muy',
                    'muchio' => 'mucho',
                    'mu' => 'muy',
                    'mui' => 'muy',
                    'nah' => 'nada',
                    'nop' => 'no',
                    'nuche' => 'no se',
                    'nus' => 'nos',
                    'nuse' => 'no se',
                    'ola' => 'hola',
                    'oe' => 'oye',
                    'olas' => 'hola',
                    'olaz' => 'hola',
                    'pic' => 'foto',
                    'pick' => 'foto',
                    'pik' => 'foto',
                    'plis' => 'por favor',
                    'pliz' => 'por favor',
                    'plz' => 'por favor',
                    'pol' => 'por',
                    'sho' => 'yo',
                    'sip' => 'si',
                    'soi' => 'soy',
                    'stoi' => 'estoy',
                    'sullo' => 'suyo',
                    'ta' => 'está',
                    'tawena' => 'está buena',
                    'tap' => 'top',
                    'taz' => 'estás',
                    'teno' => 'tengo',
                    'toi' => 'estoy',
                    'toos' => 'todos',
                    'tullo' => 'tuyo',
                    'lav' => 'love',
                    'lov' => 'love',
                    'lendo' => 'lindo',
                    'llendo' => 'yendo',
                    'mua' => 'besos',
                    'muak' => 'besos',
                    'muac' => 'besos',
                    'muack' => 'besos',
                    'muto' => 'mucho',
                    'nah' => 'nada',
                    'nu' => 'no',
                    'nueo' => 'nuevo',
                    'nunk'=> 'nunca',
                    'nuc' => 'no se',
                    'pake' => 'para que',
                    'save' => 'sabe',
                    'saven' => 'saben',
                    'vien' => 'bien',
                    'voi'=> 'voy',
                    'we' => 'bueno',
                    'wem' => 'bueno',
                    'wno' => 'bueno',
                    'xau' => 'chau',
                    'xao' => 'chao',
                    'xfa' => 'por favor'
	);
 if (array_key_exists  ( strtolower($word)  , $translations  ))
 {
  return $translations[strtolower($word)];
 }
 else
 {
  $lword = strtolower($word);
  
  if (preg_match("/emd/",$lword))
  {
   $lword = str_replace('emd', 'ind', $lword);
   $word = $lword;
  }
  else if (preg_match("/md/",$lword))
  {
   $lword = str_replace('md', 'nd', $lword);
   $word = $lword;
  }
 
  if (preg_match("/^[i]+$/",$lword))
  {
   $word = 'y';
  }

  if (strlen($lword) > 2 and substr($lword,0,3) == 'wen')
  {
   $lword = "buen".substr($lword,3);
   $word = $lword;
  }

  if (strlen($lword) > 2 and substr($lword,0,3) == 'oka')
  {
   $lword = "ok";
   $word = $lword;
  }

  //posible risa
  if (strlen($lword) > 6)
  {
   if (preg_match("/^((j|a|k)+)$/", $lword))
   {
    return "jajaja";
   }
   else if (strlen($lword) > 8 and preg_match("/^((j|a|k|h|l|s|d|ñ)+)j((j|a|k|h|l|s|d|ñ)+)j((j|a|k|h|l|s|d|ñ)*)$/", $lword))
   {
    return "jajaja";
   }
  }
  return $word;
 }
}

function desporteniar($word)
{
 $lword = strtolower($word);
 if (strlen($lword) > 5 and substr($lword,-4) == 'stes')
 {
  $lword = substr($lword,0,-1);
  $word = $lword;
 }
 return $word;
}

function desk($word)
{
 $lword = strtolower($word);

 if (preg_match("/(k)/",$lword))
 {
  if ($lword == 'ok')
   return $word;

  $exceptions=array('kiosco','kilo','kiló','kimono','karate','kilometro','shakira','shaki');
  foreach ($exceptions as $a)
  {
   if (preg_match("/".$a."/", $lword))
   {
    return $word;
   }
  }

  $palabras_gringas = get_option('mh_no_corregir_k');
  $palabras=explode(",",$palabras_gringas);

  foreach ($palabras as $palabra)
  {
   if (preg_match("/".$palabra."/", $lword))
   {
    return $word;
   }
  }

  if (!preg_match("/(ck)|(nk)|(ky)|(key)|(k$)|(ks$)|(king$)|(ked$)|(kes$)|(kies$)|(ker$)|(ki$)|(^kn)/",$lword) && gSpell($lword,'en')!=false)
  {
   $vocales = array('a', 'e', 'i', 'o','u');

   if (preg_match("/ki/",$lword))
   {
    $lword = str_replace('ki', 'qui', $lword);
    $word = $lword;
   }

   if (preg_match("/ke/",$lword))
   {
    $lword = str_replace('ke', 'que', $lword);
    $word = $lword;
   }

   if (strlen($lword) > 2 and $lword{0} == 'k' and !in_array($lword{1}, $vocales))
   {
    $lword = "ka".substr($lword,1);
    $word = $lword;
   }

   $word = str_replace('k','c', $word);
   $word = str_replace('K','C', $word);  
  }
 }

 return $word;
}

function deszezear($word)
{
 $lword = strtolower($word);

 if (preg_match("/(z)/",$lword))
 {
  $exceptions = array('arroz', 'feliz', 'zorr', 'azul', 'azucar', 'azúcar', 'conoz', 'fuerza', 'voz', 'vez', 'pez', 'cabeza','razon','raza','paz','oz','sanchez');
  foreach ($exceptions as $a)
  {
   if (preg_match("/".$a."/", $lword))
   {
    return $word;
   }
  }
  if (!preg_match("/(anza$)|(azo$)|(izar$)|(zuelo$)|(zuela$)|(azgo$)|(ezgo$)|(ezno$)/",$lword))
  {
   $word = str_replace('z','s', $word);
   $word = str_replace('Z','S', $word);
  }
 }
 return $word;
}

function deshachear($word)
{
 $lword = strtolower(quitar_puntos($word));

 if (preg_match("/(^h)/",$lword)&&strlen($lword)>1)
 {
  $exceptions = array('ha','he','han','hay','haber','hace','haceis','hacemos','hacen','hacer','haces','hacia','hacian','haciamos','hacias','haga','hagan','hagas','hagamos','hago','hare','haran','hara','haremos','harian','hasta','hola','hecha','hizo','hice','hicimos','hicieron','hicieras','hicieran','hechicera','hechiceresca','hechiceresco','hechiceria','hechicero','hechiza','hechizar','hechizo','hecho','hechor','hechora','hechura');

  if(in_array($lword, $exceptions))
   return $word;

  if(!preg_match("/(^hecto)|(^hema)|(^hemo)|(^hemi)|(^hepat)|(^hepta)|(^hetero)|(^hex)|(^hidr)|(^hiper)|(^hipo)|(^hom)|(^host)|(^horr)|(^hosp)|(^hia)|(^hie)|(^hue)|(^hui)|(^hum)|(^heli)|(^higro)|(^hij)|(^hot)|(^hoy)|(^hambr)|(^holg)|(^hambur)/",$lword))
   $word = substr($word, 1);
 }

 return $word;
}

function fixmissingvowels($word)
{
 $vocales = array('a', 'e', 'i', 'o', 'u');
 $followsd = array('a', 'e', 'i', 'o', 'u', 'r', 'h', 'y');
 $lword = strtolower($word);

 $palabras_gringas = get_option('mh_no_corregir_s_t');
 $palabras=explode(",",$palabras_gringas);
 $todo_bien=0;
 foreach ($palabras as $palabra)
 {
  if (strcasecmp($palabra, $lword) == 0)
  {
   $todo_bien=1;
   break;
  }
  else
  {
   if (stristr($lword, $palabra) == TRUE)
   {
    $todo_bien=1;
    break;
   }
  }
 }
 
 if($todo_bien==0)
 { 
  if (strlen($lword) > 1 and $lword{0} == 'n' and !in_array($lword{1}, $vocales))
  {
   $lword = "en".substr($lword,1);
   $word = $lword;
  }
  $len = strlen($lword);

  if ($len > 1 and $lword{$len-1} == 't')
  {
   if(gSpell($lword,'en')!=false)
   {
    $lword .= 'e';
    $word = $lword;
   }
  }
  
  if (strlen($lword) > 2 and substr($lword,0,2) == 'vr' and !in_array($lword{2}, $vocales))
  {
   $lword = "ver".substr($lword,2);
   $word = $lword;
  }
 
  if (strlen($lword) > 2 and $lword{0} == 'd' and !in_array($lword{1}, $followsd))
  {
   $lword = "de".substr($lword,1);
   $word = $lword;
  }

  if (strlen($lword) > 2 and substr($lword,0,2) == 'sp')
  {
   if(gSpell($lword,'en')!=false)
   {
    $lword = "esp".substr($lword,2);
    $word = $lword;
   }
  }
  
  if (strlen($lword) > 2 and substr($lword,0,2) == 'st')
  {
   if(gSpell($lword,'en')!=false)
   {
    $lword = "est".substr($lword,2);
    $word = $lword;
   }
  }
 }
 return $word;
}

function quitar_acentos($s)
{
 $s = str_replace('á', 'a', $s); 
 $s = str_replace('Á', 'A', $s); 
 $s = str_replace('é', 'e', $s); 
 $s = str_replace('É', 'E', $s); 
 $s = str_replace('í', 'i', $s); 
 $s = str_replace('Í', 'I', $s); 
 $s = str_replace('ó', 'o', $s); 
 $s = str_replace('Ó', 'O', $s); 
 $s = str_replace('Ú', 'U', $s); 
 $s= str_replace('ú', 'u', $s); 
 return $s;
}

function quitar_puntos($s)
{ 
 $patron = '/[^\wñÑáéíóúÁÉÍÓÚ$]/';

 $reemplazo = '';
 $value = preg_replace($patron,$reemplazo, trim($s));
 return $value;
} 

function retornar_keywords_post()
{ 
 $keywords_post=get_post_meta(get_the_ID(), "_aioseop_keywords", true);
 $keywords = explode(",",$keywords_post);
 return $keywords;
} 

function cadena_sin_malas_palabras($word)
{
 $malas_palabras = get_option('mh_palabras_censuradas');
 $asteriscos=0;
 $temp=quitar_acentos($word);

 $palabras=explode(",",$malas_palabras);

 foreach ($palabras as $palabra)
 {
  if (strcasecmp($palabra, $temp) == 0)
  {
   $asteriscos=1;
   break;
  }
  else
  {
   if (stristr($temp, $palabra) == TRUE)
   {
    if ( substr($temp,-1)== 's' && strlen($temp) == strlen($palabra)+1 )
     $asteriscos=1;
   else if ( substr($temp,-1)== 'e' && strlen($temp) == strlen($palabra)+1 )
     $asteriscos=1;
    else if ( substr($temp,-1)== 'n' && strlen($temp) == strlen($palabra)+1 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'na' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'ar' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'da' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'es' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'ed' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'as' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'on' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'an' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;
    else if ( substr($temp,-2) == 'te' && strlen($temp) == strlen($palabra)+2 )
     $asteriscos=1;    
    else if ( substr($temp,-3) == 'mos' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'ies' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'ing' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'nes' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'nas' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'das' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'ada' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'ndo' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-3) == 'ton' && strlen($temp) == strlen($palabra)+3 )
     $asteriscos=1;
    else if ( substr($temp,-4) == 'emos' && strlen($temp) == strlen($palabra)+4 )
     $asteriscos=1;
    else if ( substr($temp,-4) == 'adas' && strlen($temp) == strlen($palabra)+4 )
     $asteriscos=1;   
    if($asteriscos==1)
     break;
   }
  }
 } 
 if($asteriscos==1)
 {
  $tam=strlen($temp);
  for($j=0;$j<$tam;$j++)
  {
   $word_asteriscos=$word_asteriscos . '*';
  }
  return $word_asteriscos;
 }
 else
 {
  return $word;
 }
}

function eliminar_lenguaje_HOYGAN($palabra)
{
 //$result = dessimbolizar($palabra);
 //$result = deleet($result);
 //$result = desalternar($palabra);
 $result = desmultiplicar($palabra);
 //$result = desms($result);
 //$result = desestupidizar($result);

 //$result = desk($result);
 //$result = deszezear($result);
 //$result = deshachear($result);
 //$result = desporteniar($result);

 //$result = fixmissingvowels($result);

 return $result;
}

function eliminar_lenguaje_grosero($palabra)
{
 if (preg_match("/[^\wñÑáéíóúÁÉÍÓÚ$]/",$palabra))
 {
  $cadena_temp=1;
  $caracter_punto="";
  $Cad_puntos="";
  $palabra_temp="";
  for ($i=0;$i<strlen($palabra);$i++)
  {
   $caracter_punto=substr($palabra,$i,1);
   if (preg_match("/[^\wñÑáéíóúÁÉÍÓÚ$]/",$caracter_punto))
    $Cad_puntos= $Cad_puntos . $caracter_punto;
   else
    $Cad_puntos= $Cad_puntos . "X";
  }
  $palabra_temp=$palabra;
  $result=quitar_puntos($palabra);
 }
 else
 {
  $result=$palabra;
  $cadena_temp=0;
 }

 $result = cadena_sin_malas_palabras($result);

 if($cadena_temp==1)
 {
  $j=0;
  $devolver= "";
  for ($i=0;$i<strlen($palabra_temp);$i++)
  {
   $caracter_punto=substr($Cad_puntos,$i,1);
   if (preg_match("/[^\wñÑáéíóúÁÉÍÓÚ$]/",$caracter_punto))
    $devolver= $devolver . $caracter_punto;
   else
   {
    $caracter_letra=substr($result,$j,1);
    $devolver= $devolver . $caracter_letra;
    $j++;
   }
  }
  return $devolver;
 }
 else
  return $result;
}

function spanish_metaphone($string, $key_length = 6)
{  
 //initialize metaphone key string
 $meta_key   = "";
   
 //set current position to the beginning
 $current_pos   =  0;
   
 //get string  length
 $string_length   = strlen($string);
   
 //set to  the end of the string
 $end_of_string_pos     = $string_length - 1;    
 $original_string = $string. "    ";

 //Let's replace some spanish characters  easily confused
 $original_string = strtr($original_string, 'áéíóúñübzñ', 'AEIOUNUVSN');
   
 //convert string to uppercase
 $original_string = strtoupper($original_string);       
   
 // main loop
 while (strlen($meta_key) < $key_length) 
 {
  //break out of the loop if greater or equal than the length
  if ($current_pos >= $string_length)
  {
   break;
  }
        
  //get character from the string
  $current_char = substr($original_string, $current_pos, 1);
      
  //if it is a vowel, and it is at the begining of the string,
  //set it as part of the meta key        
  if (is_vowel($original_string, $current_pos) && ($current_pos == 0))
  {
   $meta_key   .= $current_char;            
   $current_pos += 1;            
  }         
  //Let's check for consonants  that have a single sound 
  //or already have been replaced  because they share the same
  //sound like 'B' for 'V' and 'S' for 'Z'
  else 
   if (string_at($original_string, $current_pos, 1, array('D','F','J','K','M','N','P','R','S','T','V')))
   {
    $meta_key   .= $current_char; 
         
    //increment by two if a repeated letter is found
    if (substr($original_string, $current_pos + 1,1) == $current_char) 
    {                     
     $current_pos += 2;             
    }  
           
    //else increment only by one                 
    $current_pos += 1;            
   }
   else  //check consonants with similar confusing sounds
   {
    switch ($current_char) 
    {
     case 'C':  
               //special case 'macho', chato,etc.      
               if (substr($original_string, $current_pos + 1,1)== 'H')
               {                                        
                  $current_pos += 2;                                 
               }      
               //special case 'acción', 'reacción',etc.      
               else if (substr($original_string, $current_pos + 1,1)== 'C')
               {                                        
                     
                  $meta_key   .= 'X';            
                  $current_pos += 2;
                  break;                                
               }          
               // special case 'cesar', 'cien', 'cid', 'conciencia'
               else if (string_at($original_string, $current_pos, 2, 
                         array('CE','CI'))) 
               {
                  $meta_key   .= 'S';            
                  $current_pos += 2;
                  break;
               }
               // else
               $meta_key   .= 'K';                   
               $current_pos += 1;            
               break;     
               
            case 'G':
               // special case 'gente', 'ecologia',etc 
               if (string_at($original_string, $current_pos, 2, 
                         array('GE','GI')))
               {
                  $meta_key   .= 'J';            
                  $current_pos += 2;
                  break;
               }
               // else
               $meta_key   .= 'G';                   
               $current_pos += 1;            
               break;
          
            //since the letter 'h' is silent in spanish, 
            //let's set the meta key to the vowel after the letter 'h'
            case 'H':                
               if (is_vowel($original_string, $current_pos + 1))
               {
                  $meta_key .= $original_string[$current_pos + 1];            
                  $current_pos += 2;
                  break;
               } 
                      
               // else
               $meta_key   .= 'H';                   
               $current_pos += 1;            
               break;    
               
            case 'Q':
               if (substr($original_string, $current_pos + 1,1) == 'U')
               { 
                  $current_pos += 2;
               }
               else 
               {
                  $current_pos += 1;
               }
            
               $meta_key   .= 'K';          
               break;   
               
            case 'W':          
               $meta_key   .= 'U';            
               $current_pos += 2;
               break;          

            case 'V':
               $meta_key   .= 'B';
               $current_pos += 1;
               break;    

            case 'N':
               $meta_key   .= 'M';
               $current_pos += 1;
               break;    

            case 'LL':
               $meta_key   .= 'Y';
               $current_pos += 1;
               break;    
              
            case 'X': 
               //some mexican spanish words like'Xochimilco','xochitl'         
               if ($current_pos == 0) 
               {                    
                  $meta_key   .= 'S';
                  $current_pos += 2; 
                  break;          
               } 
                          
               $meta_key   .= 'X';
               $current_pos += 1; 
               break;         
               
            default:
               $current_pos += 1;
               
         } // end of switch
      }//end else       
   } // end of while loop
   //trim any blank characters
   $meta_key = trim($meta_key) ;
   
   //return the final meta key string
   return $meta_key;
   
}

function string_at($string, $start, $string_length, $list) 
{
 if (($start <0) || ($start >= strlen($string)))
  return 0;
 
 for ($i=0; $i<count($list); $i++)
 {
  if ($list[$i] == substr($string, $start, $string_length))
   return 1;
 }
 return 0;
}

function is_vowel($string, $pos)
{
 return ereg("[AEIOU]", substr($string, $pos, 1));
}

function comparar_palabras($texto1, $texto2)
{
 $resul_1 = spanish_metaphone($texto1, 5);
 $resul_2 = spanish_metaphone($texto2, 5);

 similar_text($resul_1,$resul_2,$porcentaje);
 $porcentaje = number_format($porcentaje, 0);

 return porcentaje;
}

function corregir_ortografia($texto)
{
 $texto2= quitar_puntos($texto);

 $resultado_esp = gSpell($texto2,'es');

 if($resultado_esp==false)
  $resultado = $texto;
 else
 {
  $porcentaje_es=0;
  similar_text(quitar_acentos($resultado_esp),quitar_acentos($texto),$porcentaje_es);
  $porcentaje_es = number_format($porcentaje_es, 0);
  
  if($porcentaje_es >=88)
   $resultado = $resultado_esp;
  else
  {
   $resultado_en = gSpell($texto2,'en');

   if($resultado_en==false)
    $resultado = $texto;
   else
   {
    $porcentaje_en=0;
    similar_text($resultado_en,$texto,$porcentaje_en);
    $porcentaje_en = number_format($porcentaje_en, 0);

    if($porcentaje_en >=88)
     $resultado = $resultado_en;
    else
     $resultado = $texto;
   }
  }
 }
 return $resultado; 
}


function hoyganismo()
{
 if ( is_singular() && comments_open() )
 {
  $texto_inicial= 'RXN0ZSBzaXRpbyB1c2EgPGEgaHJlZj0iaHR0cDovL3dvcmRwcmVzcy5vcmcvZXh0ZW5kL3BsdWdpbnMvbWF0YS1ob3lnYW4vIiB0aXRsZT0iTUFUQS1IT1lHQU4iPk1BVEEtSE9ZR0FOPC9hPg==';

  $HOYGAN_activado= get_option('mh_HOYGAN');
  $Malas_palabras_activado= get_option('mh_censura');

  if ($HOYGAN_activado == 1 && $Malas_palabras_activado == 1)
   $texto_final= 'IHBhcmEgZWxpbWluYXIgZWwgTGVuZ3VhamUgSE9ZR0FOIHkgQ2Vuc3VyYXIgZWwgTGVuZ3VhamUgT2JzY2Vuby4=';
  else if ($HOYGAN_activado == 1 && $Malas_palabras_activado == 0)
   $texto_final= 'IHBhcmEgZWxpbWluYXIgZWwgTGVuZ3VhamUgSE9ZR0FOLg==';
  else if ($HOYGAN_activado == 0 && $Malas_palabras_activado == 1)
   $texto_final= 'IHBhcmEgQ2Vuc3VyYXIgZWwgTGVuZ3VhamUgT2JzY2Vuby4=';
  
  echo '<br /><p style="font-size:80%;" display:block>' . base64_decode($texto_inicial) . base64_decode($texto_final) .'</p>';
 }
}
add_action( 'comment_form', 'hoyganismo' );

function transformar_comentarios($words)
{
 $devolver='';
 $words = preg_replace("/(\r)|(\n)|(\r\n)|(\n\r)+/", "%salto_de_linea% ", $words);
 $palabras = preg_split("/[\s]+/",$words);
 if (get_option('mh_HOYGAN') == 1 || get_option('mh_censura') == 1)
 {
  $mh_stopwords=explode(",",MH_STOPWORDS);

  foreach ($palabras as $palabra)
  {
   if (preg_match("/(%salto_de_linea%)$/",$palabra))
   {
    $salto_de_linea = "\n";
    $palabra = preg_replace("/(%salto_de_linea%)$/", "", $palabra);
   }
   else
    $salto_de_linea = ' ';

   if (!preg_match("/^[*]+$/",$palabra))
   {
    if (!is_url($palabra) && !is_email($palabra) && es_numero_o_referencia($palabra)==0)
    {
     if (!in_array(strtolower(quitar_acentos($palabra)), $mh_stopwords))
     {
      if (get_option('mh_HOYGAN') == 1 )
       $result = eliminar_lenguaje_HOYGAN($palabra);
      else
       $result = $palabra;

      if (!in_array(strtolower(quitar_acentos($result)), $mh_stopwords))
       $result = corregir_ortografia($result);

      if (get_option('mh_censura') == 1 )
       $result = eliminar_lenguaje_grosero($result);
     }
     else
      $result =$palabra;// strtolower($palabra);
    }
    else
     $result = $palabra;
    
    $devolver = $devolver . $result . $salto_de_linea;
   }
   else
    $devolver = $devolver . $palabra . $salto_de_linea;
  }
 }
 else
  $devolver = $words;

 if (get_option('mh_SEO') == 1 )
 {
  if(strlen($devolver)>50)
  {
   $keywords= retornar_keywords_post();
   
   if($keywords)
   {
    foreach ($keywords as $keyword)
    {
     $keyword=trim($keyword);
     if(stristr($keyword,$devolver))
     {
      $tipo_sombreado=rand(0,2);
  
      if($tipo_sombreado==1)
       $devolver = str_replace_once($keyword, "<strong>" . $keyword . "</strong>", $devolver);
      else if($tipo_sombreado==2)
       $devolver = str_replace_once($keyword, "<em>" . $keyword . "</em>", $devolver);
  
      break;
     }
    }
   }
  }
 }
 return trim($devolver);
}

function str_replace_once($str_pattern, $str_replacement, $string)
{
 $str_pattern_sin_tildes=quitar_acentos(strtolower($str_pattern));
 $string_sin_tildes=quitar_acentos(strtolower($string));

 if (strpos($string_sin_tildes, $str_pattern_sin_tildes) !== false)
 {
  $occurrence = strpos($string_sin_tildes, $str_pattern_sin_tildes);
  return substr_replace($string, $str_replacement, $occurrence, strlen($str_pattern));
 }
 return $string;
}

function mata_HOYGAN($words)
{
 if (is_user_logged_in())
  return $words;
 else
  return transformar_comentarios($words);
}
add_filter('pre_comment_content', 'mata_HOYGAN');

function utf8tohtml($utf8, $encodeTags)
{
 $result = '';
 for ($i = 0; $i < strlen($utf8); $i++)
 {
  $char = $utf8[$i];
  $ascii = ord($char);
  if ($ascii < 128)
  {
   // one-byte character
   $result .= ($encodeTags) ? htmlentities($char) : $char;
  }
  else if ($ascii < 192)
  {
   // non-utf8 character or not a start byte
  }
  else if ($ascii < 224)
  {
   // two-byte character
   $result .= htmlentities(substr($utf8, $i, 2), ENT_QUOTES, 'UTF-8');
   $i++;
  }
  else if ($ascii < 240)
  {
   // three-byte character
   $ascii1 = ord($utf8[$i+1]);
   $ascii2 = ord($utf8[$i+2]);
   $unicode = (15 & $ascii) * 4096 +
                       (63 & $ascii1) * 64 +
                       (63 & $ascii2);
   $result .= "&#$unicode;";
   $i += 2;
  }
  else if ($ascii < 248)
  {
   // four-byte character
   $ascii1 = ord($utf8[$i+1]);
   $ascii2 = ord($utf8[$i+2]);
   $ascii3 = ord($utf8[$i+3]);
   $unicode = (15 & $ascii) * 262144 +
                       (63 & $ascii1) * 4096 +
                       (63 & $ascii2) * 64 +
                       (63 & $ascii3);
   $result .= "&#$unicode;";
   $i += 3;
  }
 }
 return $result;
}

function deshoyganizar_comentarios_viejos($TituloGlobal)
{
 global $wpdb;
 $ultimo_comentario = get_option('mh_ultimo_comentario');
 $id = 0;
 $count_comentarios = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->comments Where comment_ID != %d;",$id));
 @set_time_limit(0);

$SQL = $wpdb->get_results("SELECT * FROM " . $wpdb->comments, ARRAY_A);
    foreach($SQL AS $ROW) {
    $iA = transformar_comentarios($ROW['comment_content']);
	if(($iA != $ROW['comment_content']))
      {
       $wpdb->update($wpdb->comments, array( 'comment_content' => utf8tohtml($iA,false)),array('comment_ID'=>$ROW['comment_ID']),array('%s'),array('%d')); 
        }
    } 
	
 update_option( 'mh_ultimo_comentario', $count_comentarios);

 if (get_option('mensaje_ocultado')=='')
 {
  add_option('mensaje_ocultado', 'true');
 }
 else
  update_option ('mensaje_ocultado', 'true');
 //Validacion SIGOES 
$Correcciones = transformar_comentarios($TituloGlobal);
return $Correcciones;
}

function gSpell($searchterm, $lang = 'es')
{
 if(get_option('mh_terminado') == 1)
  return false;

 $url = "https://www.google.com/tbproxy/spell?lang=" .$lang. "&hl=en";

 $post_string = '<?xml version="1.0" encoding="utf-8" ?>
    			<spellrequest textalreadyclipped="0" ignoredups="0" ignoredigits="0" ignoreallcaps="0">  
    			<text>' .$searchterm. '</text>  
    			</spellrequest>';

 $header  = "POST HTTP/1.0 \r\n";
 $header .= "Content-type: text/xml \r\n";
 $header .= "Content-length: ".strlen($post_string)." \r\n";
 $header .= "Content-transfer-encoding: text \r\n";
 $header .= "Connection: close \r\n\r\n";
 $header .= $post_string;

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_TIMEOUT, 4);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
 curl_setopt($ch, CURLOPT_HEADER, $header);
 $data = curl_exec($ch);

 if(curl_errno($ch))
 {
  print curl_error($ch);
 }
 else
 {
  curl_close($ch);
 }

 if(strpos($data ," "))
 {
  if(stristr($data,"but your computer or network may be sending automated queries") != FALSE)
   return false;

  $temps = explode("\t", strip_tags($data));
  $i=0;
  foreach ($temps as $temp)
  {
   $palabras[$i]= comparar_palabras($temp, $searchterm);
   $i++;
  }
  
  for($j=0;$j<$i;$j++)
  {
   if($j==0)
   {
    $valor=$palabras[0];
    $pos=0;
   }
   else if($valor<$palabras[$j])
   {
    $valor=$palabras[$j];
    $pos=$j;
   }
  }
  $erg = $temps[$pos];

 }
 else
 {
  $erg = $data;
 }

 if($erg != "")
 {
  return $erg;
 }
 else
 {
  return false;
 }
}

function initAdminMessages()
{
 if ( isset($_GET['ocultar_mensaje']) && '0' == $_GET['ocultar_mensaje'])
 {
  update_option('mensaje_ocultado','false');
 }
}
add_action('admin_init', 'initAdminMessages');

function MostrarMensajes($message, $errormsg = false)
{
 if ($errormsg)
 {
  echo '</pre><div id="message" class="error"><p>';
 }
 else
 {
  echo '<div id="message" class="updated fade"><p>';
 }
 echo $message;
 printf(__(' | <a href="%1$s">Ocultar Mensaje</a></p></div>'), '?ocultar_mensaje=0');
}

function showAdminMessages()
{
 if (is_admin())
 {
  if (get_option('mensaje_ocultado')=='true')
  {
   if(get_option('mh_ultimo_comentario')==0)
    MostrarMensajes("No se realizo la validación");
   else
    MostrarMensajes("Validación de comunicados terminada" .get_option('mh_ultimo_comentario'));
  }
 }
}
add_action('admin_notices', 'showAdminMessages');
//Deshabilitar boton publicar hasta que cargue el form de nuevo evento, streaming
add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions2' );
function my_post_submitbox_misc_actions2(){

global $post;

//only when editing a post
if( $post->post_type == 'evento' ||$post->post_type == 'streaming'||$post->post_type == 'otros'  ){
       
    //echo "Boton Publicar Deshabilitado sino hay imagen destacada";
    echo '<script>
    jQuery(document).ready(function($){
     
      $("#publish").attr("disabled","disabled");
      
      jQuery("#title").keypress(function(){
        jQuery("#publish").removeAttr("disabled");
    });
    });
    </script>';

   }//Fin If ( $post->post_type == 'proyecto' )
 
}// Fin my_post_submitbox_misc_actions2

//Regresar cuando funcionaba
//
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
    if( /*'index.php' != $hook ||quite un */'post-new.php' != $hook /*||'post.php' != $hook || 'edit.php' != $hook quite un*/) {
  // Only applies to dashboard panel
  return;
    }
        
  wp_enqueue_script( 'ajax-script', plugins_url( '/js/ValidacionComunicado.js', __FILE__ ), array('jquery'), '1.0', true );

  // in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
  wp_localize_script( 'ajax-script', 'ajax_object',
          array( 'ajax_url' => admin_url( 'admin-ajax.php' )/*,'titulo'=>''/*,'we_value' => 10*/) );
}

// Same handler function...
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
  global $wpdb;
//$TituloPost = $_REQUEST['titulo'];
parse_str( $_POST['form_data'], $vars );//Todos los elementos del post
$tituloPost=$vars['post_title'];
$TituloGlobal=(string)$tituloPost;
$retorno=(string)deshoyganizar_comentarios_viejos($TituloGlobal);//Validando Comentarios
//$tituloMinuscula=strtolower($TituloGlobal);
$comparacion=strnatcmp($TituloGlobal, $retorno);
  if ($comparacion !== 0) {
    ob_clean();
    die('@invalido@');    
  }
  elseif($comparacion===0){
    ob_clean();
    die('@valido@');
  }
  
}