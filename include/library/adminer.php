<?php if(!defined('ADMINER_PW') || empty($_SESSION)) die('AErr4'); ?><?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.6.3
*/error_reporting(6135);$Wc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($Wc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Di=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Di)$$X=$Di;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($u){$ne=substr($u,-1);return
str_replace($ne.$ne,$ne,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($ng,$Wc=false){if(get_magic_quotes_gpc()){while(list($y,$X)=each($ng)){foreach($X
as$ce=>$W){unset($ng[$y][$ce]);if(is_array($W)){$ng[$y][stripslashes($ce)]=$W;$ng[]=&$ng[$y][stripslashes($ce)];}else$ng[$y][stripslashes($ce)]=($Wc?$W:stripslashes($W));}}}}function
bracket_escape($u,$Oa=false){static$oi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Oa?array_flip($oi):$oi));}function
min_version($Ui,$Ae="",$h=null){global$g;if(!$h)$h=$g;$ih=$h->server_info;if($Ae&&preg_match('~([\d.]+)-MariaDB~',$ih,$B)){$ih=$B[1];$Ui=$Ae;}return(version_compare($ih,$Ui)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($sh,$ni="\n"){return"<script".nonce().">$sh</script>$ni";}function
script_src($Ii){return"<script src='".h($Ii)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($C,$Y,$fb,$je="",$pf="",$kb="",$ke=""){$I="<input type='checkbox' name='$C' value='".h($Y)."'".($fb?" checked":"").($ke?" aria-labelledby='$ke'":"").">".($pf?script("qsl('input').onclick = function () { $pf };",""):"");return($je!=""||$kb?"<label".($kb?" class='$kb'":"").">$I".h($je)."</label>":$I);}function
optionlist($vf,$ch=null,$Mi=false){$I="";foreach($vf
as$ce=>$W){$wf=array($ce=>$W);if(is_array($W)){$I.='<optgroup label="'.h($ce).'">';$wf=$W;}foreach($wf
as$y=>$X)$I.='<option'.($Mi||is_string($y)?' value="'.h($y).'"':'').(($Mi||is_string($y)?(string)$y:$X)===$ch?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($C,$vf,$Y="",$of=true,$ke=""){if($of)return"<select name='".h($C)."'".($ke?" aria-labelledby='$ke'":"").">".optionlist($vf,$Y)."</select>".(is_string($of)?script("qsl('select').onchange = function () { $of };",""):"");$I="";foreach($vf
as$y=>$X)$I.="<label><input type='radio' name='".h($C)."' value='".h($y)."'".($y==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ka,$vf,$Y="",$of="",$Zf=""){$Sh=($vf?"select":"input");return"<$Sh$Ka".($vf?"><option value=''>$Zf".optionlist($vf,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Zf'>").($of?script("qsl('$Sh').onchange = $of;",""):"");}function
confirm($Ke="",$dh="qsl('input')"){return
script("$dh.onclick = function () { return confirm('".($Ke?js_escape($Ke):lang(0))."'); };","");}function
print_fieldset($t,$se,$Xi=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$se</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($Xi?"":" class='hidden'").">\n";}function
bold($Wa,$kb=""){return($Wa?" class='active $kb'":($kb?" class='$kb'":""));}function
odd($I=' class="odd"'){static$s=0;if(!$I)$s=-1;return($s++%2?$I:'');}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
json_row($y,$X=null){static$Xc=true;if($Xc)echo"{";if($y!=""){echo($Xc?"":",")."\n\t\"".addcslashes($y,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$Xc=false;}else{echo"\n}\n";$Xc=true;}}function
ini_bool($Pd){$X=ini_get($Pd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($Ti,$N,$V,$F){$_SESSION["pwds"][$Ti][$N][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($Q){global$g;return$g->quote($Q);}function
get_vals($G,$e=0){global$g;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$e];}return$I;}function
get_key_vals($G,$h=null,$lh=true){global$g;if(!is_object($h))$h=$g;$I=array();$H=$h->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($lh)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$h=null,$n="<p class='error'>"){global$g;$yb=(is_object($h)?$h:$g);$I=array();$H=$yb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($h)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$I;}function
unique_array($J,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$I=array();foreach($v["columns"]as$y){if(!isset($J[$y]))continue
2;$I[$y]=$J[$y];}return$I;}}}function
escape_key($y){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$y,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($y);}function
where($Z,$p=array()){global$g,$x;$I=array();foreach((array)$Z["where"]as$y=>$X){$y=bracket_escape($y,1);$e=escape_key($y);$I[]=$e.($x=="sql"&&preg_match('~^[0-9]*\.[0-9]*$~',$X)?" LIKE ".q(addcslashes($X,"%_\\")):($x=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$y],q($X))));if($x=="sql"&&preg_match('~char|text~',$p[$y]["type"])&&preg_match("~[^ -@]~",$X))$I[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$y)$I[]=escape_key($y)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$p=array()){parse_str($X,$db);remove_slashes(array(&$db));return
where($db,$p);}function
where_link($s,$e,$Y,$rf="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$rf:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$L=array()){$I="";foreach($f
as$y=>$X){if($L&&!in_array(idf_escape($y),$L))continue;$Ha=convert_field($p[$y]);if($Ha)$I.=", $Ha AS ".idf_escape($y);}return$I;}function
cookie($C,$Y,$ve=2592000){global$ba;return
header("Set-Cookie: $C=".urlencode($Y).($ve?"; expires=".gmdate("D, d M Y H:i:s",time()+$ve)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($cd=false){if(!ini_bool("session.use_cookies")||($cd&&@ini_set("session.use_cookies",false)!==false))session_write_close();}function&get_session($y){return$_SESSION[$y][DRIVER][SERVER][$_GET["username"]];}function
set_session($y,$X){$_SESSION[$y][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ti,$N,$V,$l=null){global$fc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($fc))."|username|".($l!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($Ti!="server"||$N!=""?urlencode($Ti)."=".urlencode($N)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($A,$Ke=null){if($Ke!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($A!==null?$A:$_SERVER["REQUEST_URI"]))][]=$Ke;}if($A!==null){if($A=="")$A=".";header("Location: $A");exit;}}function
query_redirect($G,$A,$Ke,$zg=true,$Dc=true,$Oc=false,$ai=""){global$g,$n,$b;if($Dc){$_h=microtime(true);$Oc=!$g->query($G);$ai=format_time($_h);}$vh="";if($G)$vh=$b->messageQuery($G,$ai,$Oc);if($Oc){$n=error().$vh.script("messagesPrint();");return
false;}if($zg)redirect($A,$Ke.$vh);return
true;}function
queries($G){global$g;static$sg=array();static$_h;if(!$_h)$_h=microtime(true);if($G===null)return
array(implode("\n",$sg),format_time($_h));$sg[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$g->query($G);}function
apply_queries($G,$T,$_c='table'){foreach($T
as$R){if(!queries("$G ".$_c($R)))return
false;}return
true;}function
queries_redirect($A,$Ke,$zg){list($sg,$ai)=queries(null);return
query_redirect($sg,$A,$Ke,$zg,false,!$zg,$ai);}function
format_time($_h){return
lang(1,max(0,microtime(true)-$_h));}function
remove_from_uri($Kf=""){return
substr(preg_replace("~(?<=[?&])($Kf".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($E,$Kb){return" ".($E==$Kb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($y,$Sb=false){$Uc=$_FILES[$y];if(!$Uc)return
null;foreach($Uc
as$y=>$X)$Uc[$y]=(array)$X;$I='';foreach($Uc["error"]as$y=>$n){if($n)return$n;$C=$Uc["name"][$y];$ii=$Uc["tmp_name"][$y];$_b=file_get_contents($Sb&&preg_match('~\.gz$~',$C)?"compress.zlib://$ii":$ii);if($Sb){$_h=substr($_b,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$_h,$Eg))$_b=iconv("utf-16","utf-8",$_b);elseif($_h=="\xEF\xBB\xBF")$_b=substr($_b,3);$I.=$_b."\n\n";}else$I.=$_b;}return$I;}function
upload_error($n){$He=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?lang(2).($He?" ".lang(3,$He):""):lang(4));}function
repeat_pattern($Xf,$te){return
str_repeat("$Xf{0,65535}",$te/65535)."$Xf{0,".($te%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($Q,$te=80,$Gh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$te).")($)?)u",$Q,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$te).")($)?)",$Q,$B);return
h($B[1]).$Gh.(isset($B[2])?"":"<i>...</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($ng,$Fd=array()){$I=false;while(list($y,$X)=each($ng)){if(!in_array($y,$Fd)){if(is_array($X)){foreach($X
as$ce=>$W)$ng[$y."[$ce]"]=$W;}else{$I=true;echo'<input type="hidden" name="'.h($y).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($R,$Pc=false){$I=table_status($R,$Pc);return($I?$I:array("Name"=>$R));}function
column_foreign_keys($R){global$b;$I=array();foreach($b->foreignKeys($R)as$q){foreach($q["source"]as$X)$I[$X][]=$q;}return$I;}function
enum_input($U,$Ka,$o,$Y,$uc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Ce);$I=($uc!==null?"<label><input type='$U'$Ka value='$uc'".((is_array($Y)?in_array($uc,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Ce[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$I.=" <label><input type='$U'$Ka value='".($s+1)."'".($fb?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$I;}function
input($o,$Y,$r){global$zi,$b,$x;$C=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$Fa=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Fa[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Fa);$r="json";}$Ig=($x=="mssql"&&$o["auto_increment"]);if($Ig&&!$_POST["save"])$r=null;$ld=(isset($_GET["select"])||$Ig?array("orig"=>lang(8)):array())+$b->editFunctions($o);$Ka=" name='fields[$C]'";if($o["type"]=="enum")echo
h($ld[""])."<td>".$b->editInput($_GET["edit"],$o,$Ka,$Y);else{$vd=(in_array($r,$ld)||isset($ld[$r]));echo(count($ld)>1?"<select name='function[$C]'>".optionlist($ld,$r===null||$vd?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($ld))).'<td>';$Rd=$b->editInput($_GET["edit"],$o,$Ka,$Y);if($Rd!="")echo$Rd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ka value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ka value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Ce);foreach($Ce[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$s]' value='".(1<<$s)."'".($fb?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($Yh=preg_match('~text|lob~',$o["type"]))||preg_match("~\n~",$Y)){if($Yh&&$x!="sqlite")$Ka.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ka.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ka>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ka cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Je=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$B)?((preg_match("~binary~",$o["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$o["unsigned"]?1:0)):($zi[$o["type"]]?$zi[$o["type"]]+($o["unsigned"]?0:1):0));if($x=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Je+=7;echo"<input".((!$vd||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Je?" data-maxlength='$Je'":"").(preg_match('~char|binary~',$o["type"])&&$Je>20?" size='40'":"")."$Ka>";}echo$b->editHint($_GET["edit"],$o,$Y);$Xc=0;foreach($ld
as$y=>$X){if($y===""||!$X)break;$Xc++;}if($Xc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $Xc), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$u=bracket_escape($o["field"]);$r=$_POST["function"][$u];$Y=$_POST["fields"][$u];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return($o["on_update"]=="CURRENT_TIMESTAMP"?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$Uc=get_file("fields-$u");if(!is_string($Uc))return
false;return$m->quoteBinary($Uc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$I=array();foreach((array)$_POST["field_keys"]as$y=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$y];$_POST["fields"][$X]=$_POST["field_vals"][$y];}}foreach((array)$_POST["fields"]as$y=>$X){$C=bracket_escape($y,1);$I[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($y==$m->primary),);}return$I;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$fh="<ul>\n";foreach(table_status('',true)as$R=>$S){$C=$b->tableName($S);if(isset($S["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$H=$g->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($R),array())),1));if(!$H||$H->fetch_row()){$jg="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$fh<li>".($H?$jg:"<p class='error'>$jg: ".error())."\n";$fh="";}}}echo($fh?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($Dd,$Te=false){global$b;$I=$b->dumpHeaders($Dd,$Te);$Hf=$_POST["output"];if($Hf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Dd).".$I".($Hf!="file"&&!preg_match('~[^0-9a-z]~',$Hf)?".$Hf":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$y=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$J[$y]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$Vc=@tempnam("","");if(!$Vc)return
false;$I=dirname($Vc);unlink($Vc);}}return$I;}function
file_open_lock($Vc){$jd=@fopen($Vc,"r+");if(!$jd){$jd=@fopen($Vc,"w");if(!$jd)return;chmod($Vc,0660);}flock($jd,LOCK_EX);return$jd;}function
file_write_unlock($jd,$Mb){rewind($jd);fwrite($jd,$Mb);ftruncate($jd,strlen($Mb));flock($jd,LOCK_UN);fclose($jd);}function
password_file($i){$Vc=get_temp_dir()."/adminer.key";$I=@file_get_contents($Vc);if($I||!$i)return$I;$jd=@fopen($Vc,"w");if($jd){chmod($Vc,0660);$I=rand_string();fwrite($jd,$I);fclose($jd);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$_,$o,$Zh){global$b;if(is_array($X)){$I="";foreach($X
as$ce=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($ce):"")."<td>".select_value($W,$_,$o,$Zh);return"<table cellspacing='0'>$I</table>";}if(!$_)$_=$b->selectLink($X,$o);if($_===null){if(is_mail($X))$_="mailto:$X";if(is_url($X))$_=$X;}$I=$b->editVal($X,$o);if($I!==null){if(!is_utf8($I))$I="\0";elseif($Zh!=""&&is_shortable($o))$I=shorten_utf8($I,max(0,+$Zh));else$I=h($I);}return$b->selectVal($I,$_,$o,$X);}function
is_mail($rc){$Ia='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$ec='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Xf="$Ia+(\\.$Ia+)*@($ec?\\.)+$ec";return
is_string($rc)&&preg_match("(^$Xf(,\\s*$Xf)*\$)i",$rc);}function
is_url($Q){$ec='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($ec?\\.)+$ec(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($R,$Z,$Xd,$od){global$x;$G=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($Xd&&($x=="sql"||count($od)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$od).")$G":"SELECT COUNT(*)".($Xd?" FROM (SELECT 1$G GROUP BY ".implode(", ",$od).") x":$G));}function
slow_query($G){global$b,$ki,$m;$l=$b->database();$bi=$b->queryTimeout();$ph=$m->slowQuery($G,$bi);if(!$ph&&support("kill")&&is_object($h=connect())&&($l==""||$h->select_db($l))){$he=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$he,'&token=',$ki,'\');
}, ',1000*$bi,');
</script>
';}else$h=null;ob_flush();flush();$I=@get_key_vals(($ph?$ph:$G),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$vg=rand(1,1e6);return($vg^$_SESSION["token"]).":$vg";}function
verify_token(){list($ki,$vg)=explode(":",$_POST["token"]);return($vg^$_SESSION["token"])==$ki;}function
lzw_decompress($Sa){$ac=256;$Ta=8;$mb=array();$Kg=0;$Lg=0;for($s=0;$s<strlen($Sa);$s++){$Kg=($Kg<<8)+ord($Sa[$s]);$Lg+=8;if($Lg>=$Ta){$Lg-=$Ta;$mb[]=$Kg>>$Lg;$Kg&=(1<<$Lg)-1;$ac++;if($ac>>$Ta)$Ta++;}}$Zb=range("\0","\xFF");$I="";foreach($mb
as$s=>$lb){$qc=$Zb[$lb];if(!isset($qc))$qc=$ij.$ij[0];$I.=$qc;if($s)$Zb[]=$ij.$qc[0];$ij=$qc;}return$I;}function
on_help($sb,$mh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $sb, $mh) }, onmouseout: helpMouseout});","");}function
edit_form($a,$p,$J,$Gi){global$b,$x,$ki,$n;$Lh=$b->tableName(table_status1($a,true));page_header(($Gi?lang(10):lang(11)),$n,array("select"=>array($a,$Lh)),$Lh);if($J===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$C=>$o){echo"<tr><th>".$b->fieldName($o);$Tb=$_GET["set"][bracket_escape($C)];if($Tb===null){$Tb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Tb,$Eg))$Tb=$Eg[1];}$Y=($J!==null?($J[$C]!=""&&$x=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($J[$C])?array_sum($J[$C]):+$J[$C]):$J[$C]):(!$Gi&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Tb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$C]:($Gi&&$o["on_update"]=="CURRENT_TIMESTAMP"?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$o["type"])&&$Y=="CURRENT_TIMESTAMP"){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Gi?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Gi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."...', this); };"):"");}}echo($Gi?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$ki,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7������Fé�vt2���!�r0���t~�U�'3M��W�B�'c�P�:6T\rc�A�zr_�WK�\r-�VNFS%~�c���&�\\^�r����u�ŎÞ�ً4'7k����Q��h�'g\rFB\ryT7SS�P�1=ǤcI��:�d��m>�S8L�J��t.M���	ϋ`'C����889�� �Q����2�#8А����6m����j��h�<�����9/��:�J�)ʂ�\0d>!\0Z��v�n��o(���k�7��s��>��!�R\"*nS�\0@P\"��(�#[���@g�o���zn�9k�8�n���1�I*��=�n������0�c(�;�à��!���*c��>Ύ�E7D�LJ��1����`�8(��3M��\"�39�?E�e=Ҭ�~������Ӹ7;�C����E\rd!)�a*�5ajo\0�#`�38�\0��]�e���2�	mk��e]���AZs�StZ�Z!)BR�G+�#Jv2(���c�4<�#sB�0���6YL\r�=���[�73��<�:��bx��J=	m_ ���f�l��t��I��H�3�x*���6`t6��%�U�L�eق�<�\0�AQ<P<:�#u/�:T\\>��-�xJ�͍QH\nj�L+j�z��7���`����\nk��'�N�vX>�C-T˩�����4*L�%Cj>7ߨ�ި���`���;y���q�r�3#��} :#n�\r�^�=C�Aܸ�Ǝ�s&8��K&��*0��t�S���=�[��:�\\]�E݌�/O�>^]�ø�<����gZ�V��q����� ��x\\������޺��\"J�\\î��##���D��x6��5x�������\rH�l ����b��r�7��6���j|����ۖ*�FAquvyO��WeM����D.F��:R�\$-����T!�DS`�8D�~��A`(�em�����T@O1@��X��\nLp�P�����m�yf��)	���GSEI���xC(s(a�?\$`tE�n��,�� \$a��U>,�В\$Z�kDm,G\0��\\��i��%ʹ� n��������g���b	y`��Ԇ�W� 䗗�_C��T\ni��H%�da��i�7�At�,��J�X4n����0o͹�9g\nzm�M%`�'I���О-���7:p�3p��Q�rED������b2]�PF����>e���3j\n�߰t!�?4f�tK;��\rΞи�!�o�u�?���Ph���0uIC}'~��2�v�Q���8)���7�DI�=��y&��ea�s*hɕjlA�(�\"�\\��m^i��M)��^�	|~�l��#!Y�f81RS����!���62P�C��l&���xd!�|��9�`�_OY�=��G�[E�-eL�CvT� )�@�j-5���pSg�.�G=���ZE��\$\0�цKj�U��\$���G'I�P��~�ځ� ;��hNێG%*�Rj�X[�XPf^��|��T!�*N��І�\rU��^q1V!��Uz,�I|7�7�r,���7���ľB���;�+���ߕ�A�p����^���~ؼW!3P�I8]��v�J��f�q�|,���9W�f`\0�q�Z�p}[Jdhy��N�Y|�Cy,�<s A�{e�Q���hd���Ǉ �B4;ks&�������a�������;˹}�S��J���)�=d��|���Nd��I�*8���dl�ѓ�E6~Ϩ�F����X`�M\rʞ/�%B/V�I�N&;���0�UC cT&.E+��������@�0`;���G�5��ަj'������Ɛ�Y�+��QZ-i���yv��I�5��,O|�P�]Fۏ�����\0���2�49͢���n/χ]س&��I^�=�l��qfI��= �]x1GR�&�e�7��)��'��:B�B�>a�z�-���2.����bz���#�����Uᓍ�L7-�w�t�3ɵ��e���D��\$�#���j�@�G�8� �7p���R�YC��~��:�@��EU�J��;67v]�J'���q1ϳ�El�QІi�����/��{k<��֡M�po�}��r��q�؞�c�ä�_m�w��^�u������������ln���	��_�~�G�n����{kܞ�w���\rj~�K�\0�����-����B�;����b`}�CC,���-��L��8\r,��kl�ǌ�n}-5����3u�gm��Ÿ�*�/������׏�`�`�#x�+B?#�ۏN;OR\r����\$�����k��ϙ\01\0k�\0�8��a��/t���#(&�l&���p��삅���i�M�{�zp*�-g���v��6�k�	���d�؋����A`@`�'�m�P��.�K\0\r�PIr/�d��^`��V��J`�@��\r��`z��x�^�z�f�����`N\nx��yQ�\0h\0\\�@�r�*�q�l>1*�QT����h@�K�\r�@�@�\r��di�1��+F�B\".��`\\\0k�@*\0�@N@d \\+P\0p��ȟEʵ\0hc� cq����c���Np kѭ��`�_1g���r�y1����q���\0�Q�\0XM1��kN`gA#1����(�hQ?Q�Q� ��\n�� 1w!H�!�O���\"\$�rN<\0Y\$�Q\0dr��zDҔW�+#�>�%\0q\"��W�Tqe%��?&�р ��nr&�'Ry�}\"Qq>�&�k%\0rD��+����%�&�-2�-��'*5!��2�r��m/���/q�D�i��1�+��0r�%�	0��-��'�1�w�'�m��h�\0l��p2�\"��7`a7��\$��EbQ(����L\\��K[(�k�c9��s�ѺKP`mӹ8��<1@ o%��@o<3�<��=��;��@b2P�@p%S�?r��]:��29@T	?RC:t2��/S�%R��D�M�s�B�o7�O\0fD�@m)r�DR�\$bQ�O�9Sk6�TSq&�bK^o\r������h m:`�/��.h�.�gH1;-t����14�1�)J\"�J<���1T�1��6�.,�j�bC,,O�3Mx3�Z`l�q�¨{���(��4H��K�b���� �\0�C����X���Pj4��zP��D����ob�o�d�E�_.<R�>�Kz���g3�{Ge4�@�֫䊍p�'�J�o�κ�O� d5KT�SUW/Z\0Be�@�`8���5�YBOb@*����0ǅ���W�Q�6�#Ru+Q'���R\0EU(��v�\\@D`�Fp��[�^C&_5�\\��R �q��\r�+T#ұ��L���>!)B�)GG��A*�#B9a�@��̎k�m�F �U,�V<�*�L�����	c�,���x�)b�&Q���mCJ�v\"�)'g��`�&�8K�>�q^��dˢ&V8�K���vL����\$�v��eɽj��lLmk⬖l��d�pOtZ��0T�iv�Jt�n��i�n��UV�n�o6�jk�n�����jK��qV�g��o��0wq��J�3r�%l�n�!pˤ\r �rw1�Cd�=nw*W9c�Wo�}�mr6;kW?u�SrWqs6�wwort�v��tW{vT�p��j7(0wCywsT�k���יxt�h)Gt�sw�{V�v7˷��wct�|��{w�o׿}w�t��zW�k�'x��0�ʛ׏}3y����}׳~�~w	x�.�;\0b*���h6�qW�_�z*\r�}���Q<ՄH�xBŠv�,gr�BЄCԪ�b��Gf��C^��+��b�'�M-�|�ZZxt-��tC�FN��������>�l��p6PV��6`J��-;.xZ'�%���fа���hL5l�x��cĥh&~{a�*?�I�[HXD�(�&Nc��X���������g:lLGdz=�Y��v�GH4��8���N�;[dF���,,��e�/[�Cǒ�-H���Y-�'c6��#��X�Vh����Wr\r&�,8x��@fS�Q<R�l��K4��4<�n��4�n��W	0Z����T�����<�.��7�m��v�]6���e���n�|.�囪z4���)�8�X��>��T�Nݝؒ��۔����c-���l�\rÆ.��4���]�M�5�V�t�4\rHB��k@o-R���9l�9���ӜY�u,g�N@�˃·L�΍�Nt���+��x�:}j�\\v�S�����S����MH=G�\rzkS��TkG�*�U��o�sE�s�?�j�At��w'Fy�Ma��vgjv�N\rHU�^6��X��Lt�M�˫���G��wGyNE���\r���T�S���qGd�p2R��Q��-�\$��d��e�)X<�CǴHg6�ͳ�δ��UU��GoK���m��UNYI\0���E�,�gnV�;z��O75P:5��d�#%5�i`��P{�,{Ǫ�Tj�a��\n{�w���'��ϙ&5�o�v��A�����k����;;O���������1iWZ�[���e\$�|�e�����]�q�ŋ��0���h;���(��\09�����\r��<Hyőp*��{�=���`�4Z�}�ī�rF�p%#�ri��ng&w���BʑE�P@{˻W`hxE�[��-�.�8-)2�-����y�~���WP��b�t<��4��V��4�Lƺ Fϋ\"�PZ���P����(���};�X���Hl��\$q� ���z\r�\$�f�Bu�����O'�4O9�]=ѫ�Hm&ɺ�=<\0X1�U���}ӽ�l=p]�LJ�w2��UX[��	�\"IΛ)�\ri��}�#=���E��%=��}�����B3�}��H�}������m}u��Kם�U�gܽ���J�٪�C��K��I��>=����	��~ �=�ĽOٝ��]�ᕌ��>\0�w�l}�����=��<��mM�N���O�������]}̐%�A�'�c��\0@m�\\#�`�`UR%�6�\\)��`��Rp�4�\r��)�����g���q�`��� |o�� t����Q���?#���0Q*݂?t[�7@Arw��L�kL��)������5'd��A�Q+aE�e����ۢا��QC\0wETq����2f�EU\0k@QQ)\n�6�9����M���)�J:?�C���%ʀ_���A\"�����`h<��;�ߍ�?���������a�ߚ��(_c2��(S0����F���ۦF�9n![��ק��g���gn���iz�ZP���2���!8{�ʈj=�H�{���������v|*�^�h����m|\0I�f�B���o�;�����;>�)�)�4��g�O�D�&@���Т����2��b'�ռ���w}|�D�4��\0)�}�.x�G߿��O���������4�i������\no�C�	^`���`h9�@Lz���BW(��ǧ*D�Mz�M(=e\rHl���Kg�?��Od{�^���葁T)^���BB��l{r#��>�;s������K|�O`���!#��)���3���ۆR(BF�0>M�K��!���0���iAt��e%�y`@�\0&\0����=����2)j�bF@�T�A��o�\0 �\0004�(��\\�aUH��,���\\#a\0�H��\r�z�Z�7�BpOp�z��7\n\$=�z�/{�- k\n�>=���s�x`�Y\n��@��\\��>X_\0�Ă0a���'��qK�k��N��,CE���	5��B��)��I|�7h�qe��d�<ʤ4C*)�҅!֛d��2,����Y�(�D�,B�yxH���C��l%b<�xL�R\$P���!C�>Į00���j��\"Rq4�h�oXB���b�7�C	���<R����_��=�H�SU��+�:\$vw\\T��0�\$v5���V�n�rb�X�\0�	��O\rT0p%�i�H�\r����\"5;�1��w���g�0	N�^���(턞;���x\0[\$WG�;�-�8�R����+1�KP#�X�G�>���\$��̌��C�@��P>�e x��:<�D�~R)�����N\n^�P�1�:?Q��Zed���HA@L�����`HbE��T��?# 6(������k\"�H�C��T��\")��?�Q�4�\$� �\r�8P�\"9�F~��\"C2W��;\$�%� ���e��T��&8���?�22���'i0H�A2�,}�ʗ�9ǢK�`��p\$�iHjNR ��\r#�tf��.���^ �hqE�/�ل�b,�H��e��ޚ�KF����bF�8P=�q*��g�e�=�&1����'��@�'q���O�y�&�|��Fi���,�n\0��P���\r#F�i'�ΖԳe�\r�\"�v+cP�DW�grC��mF�6�Z����a\0006J�7\0[/I\0�;h�*Ĕ���)K1`7���DW�qInO��F�#fm�r��A(�N��Q�Z�z��(`8OH��斩��@i{ZJ\0n�)��|�K�t�X���#�(�0��P�|������\n,ͣ�3\$O��/�ч��\\ĝH��Vi	�ʀ������?ɘJ�&L� 6�b)����f��L2_h٘�\n�I���h���\0p�|�+3qF�c��UbI\r:�3G�\r��&��CY�ɕ��\0�8���+I�p&4��q��M	L|��ٿ������#�9ٴN���Pt@[8�����J��e�:\0N��H�6Q�I�\0����@�:�1N�*s����d���<+O��i�#b6%�M��e�wʥd%3Տ\"5�r��Li7E�����q=r���SR��iKDS0}�Kq<c�!��mask��t�b�-�����I��\"P%ա�-{CDxY'ɶ��d[�Htl#����B1z~O�xy���;�\n<km�N�:�]�l|�\n��s��x�g�=��`������iY��g��R/0q�M��n���B�H!\"~��SgxA_��� d0�L�W:�y�tQ����CEп���_���Ƨq���)M#SQb�8���6)��8>y��8悸��MAb���Sf!��tBXt	R˓���F��	�R_�;���t5�G�kPa��*i���0��(��f<R[�4�#��+���D~�D�}��J�²��oRL�,6�#\nn-\0��.�����xiJ�_Ұ�-j��h�l���ƕ�M�����ӓ!\0@\"\0��/ �M2s)x~�7��M�p'�>�OGJb��1 ���%a�YD�22���N%�\n�]Fjѝ��*c/g������/�-�e>��H�'Դ�sDn�^7�ɨ�Z��.�ˊ92���m�t�D\r��P5���ήL3����&���9��JIkD���Zٓ�}`6�\r\0�)���7H�~p�'�#����\n*R߃9�r�`�Z\r�Φe�n�g�P�&������s�i,u��tTi6��J]PTP�jduy�������;s�%R���f���,UC���\\���\r7SNR~d:��ھD��-<u���ژ(�`9��Ѱ&�φ�h㪅U�U��UjC�Q�����TA^�Ҵ!��\n���0EC�<��J���d��\n<[��c���&�A?�Q\$��aU��<�{�8��S�W*�ՆMj	Mv����iL��P�z7��'�o�JM�b��Z��K�H`6��v���տ:�UV�#�P9���NG\rK�=��M��	(k��*~m'�%2	MЃQؕ��Usw���9@X���-�Ez����1�ԘS(�d���9S�N�O'��{̞��C�-WQ���U2�*�}�lb�?\n����u�/V������Iw�旴���2��~PI��{\n\"�*�@��;@d����n �Q��dF�։��E\r���TuUּܳ�tc�Wt�Y�s+��_)9��H\"+H�s�>��ɱ5߮jZ��SWV޴��IlN�K(�:�V-�}�,�U������L�}7�mצѕě�U,+i����_�j��k�iz&V�I���cdp�H�X�EG\${�o �u&�o�L����z��&�72{�Ŝ'K'�:W�B+PD�'�����~i�VG�w��_ʯW��)��m�m_[־�u/���r4n�b�r��s��/t��J���'�cE\r��b%��Tm�b���9V��}��&=�O-Ws\ri�Л��B�N�a\0�aYT����w,\r��Q��z�ܮ� h�'�irq93�DJ8\r\0�t+\"�����J'�Cy\nͱ<-���[ۀ�K��&�E��E�\\C�Gn��yP��fqj���f�9�un�Tk���Ḻ*ng't��].twM�\r���+�Gm2�!��kgwu���yL�tQ�/\r>�]��C(��IK���0�D�T:�4�o���]��Mf��XzF�uh�̈�b?��&��g��{�)�i=!(F����;�\$�>B�GQ΢���5.���Z��ֻ�bV'���#�=��N�?*���P�Z�\nb��FՅ,�߶c	YP����7���s�����l4v�.D���\n=��Z���y;姨���{'�&�o�+�%��P�u��\0003���![!`z��\rN�����`&��n������^�<\0003�\0�{D�I|U�G<�f9b��^��%���-��HD�Rm_�L���K�6�\r���Q<���'#.�Ou\\������5ǲ�f/�\$�L��Gm�k�=��P-#�����<�����; C��5����UE��im}S�\\,�\0�:~�[qdvb!6F�E�TD�bT�\n\"� 0L\\���a��J6�Y�,�a,�����o?����Ԑ/�<T�O8�Ć����%gO�T'(����e	^�z����Th��bƚ��B�|1�\"\"Xm��u��F@O-���gu �=IN��#�5�ϗT�0X*���#Ҁ�����Y��T�<\$�h���I�W<���vS7,�)VLD�Н�J�ܜtl[e(�a	p��B�^���������({�������q�y������r8\"��U@n�O�]�,���Ύ_��ɔ�f9���̭\$�+UZ6DWn��\$j�uy���&�\"��,�Y�S�0J�����,�T�4��^��`M�6��<���V��|���UE���eJ�6Z��(�R�\n��V�vi��07N�ŜmK��rOK0gm�_�˗��(�A�~��Ӟ�;R�lW�Rɞ_��\\���.w��.,`�x.+�¤�HsT`b���O�Պ@2���ZqC&O�fl��K!�s>��p����a#�̶Hg�lo��6ᖢhP�9,ݓ�ۦ�3X��с5~��PC��(3��2 <�]�a~�ּ�ʶ1q\$��>1}O���\n��Ĩ1�yPLe�����4*|j�\"�N�p4i�jKR�&��4�ޠ��WC\r��9ch�1��H'��D�q�RH�ԚU(�9��O�cY����������u\$�r7��%#!{�UP��b3Qۣ�#��\$���y���(\ri�E����;��L��C�=�\$;Yڹߵ3��J.g@pe#�w���X\r@����=����;1TY̝;`��|�\nh漳}�V�#�ZTxj \\�VJL�&��gI�82���#���\n�X&����ڔ�����X�2q2m;V�f�R���dt/I�;HǯQ�2�n�\0gt���(�ř2s35;��\$];	ꘔ�^�/�f�rq��r���\$Q7vЖ�����>	�7wQ��n�/���Hu��2,�R7vd�hxw��������]\r�׊3��_�x���s\0׊/���]z�:83����-'8�}&�%5y`�FUP�����y�����mEi�v���HpM='��i��M�O�\$�\0�\nw	N�#�e�XVN=z�E�@���K��J�����I����ť26�Ni�[���`7I�~t�Q:�x�l�J��Ǫ�/@#uHj�^�ky5�֓Q2'E\0�x�_�,)�UC�uҞ�9��7:Y~>��Xd�m�g�]��z��{ͭG�ge����h=�l�E����@��+HX`����5@�ټu�Hb�'5����R,��ْS6{py�p�ߒ`n��M�oj��֤���{�fו���ܖ�m8�ҧP?VI�r6Q�2]����S��P~�\0�}_J;B^E��%�c�ƀ�p���\$^�?H��&��>z��՛����D�>fu��,�%�P��4�i��c<�P؃��c��lg�P��Nw�3�@�F�D��`0ތhP�����F's�h��ŀ+�R*�W�]U��\r\0�_�>���%���`���J�i�\"��\\�����	����C���63��Y����M�o��BW�\r�y��m]-NX�\\�z|&��U(��\\<W������i]\\#W��!�%~��_[��@��c����\n8�¾0���k\\�¢�R���y���?P��B��r���M8�F���Ъg\reC`�N)����]����M�T�\\j�(�>'�P��]\\~��)Ŝ*�?r�.|�t��J���mSF�|-y��б�tt��/gxT��-�,�C���`��Ʀ�-����nSz&OH���T�AsK��\\�L���8a�G\r��SdΈ|��\n<\"�mŸ�x�xEyȐ�D\$.\"?�4��7G<� o�GA3�nc����W9�Banqs����[�D�B�����K/٥���x��ϝ)2yKM�VJ�	���I�p��A7��`r�8d���<a-3�J�1ʅ{=�L��y��f�)��Kh��8�Z�E7�-ړE}�Й�];\r'O��&\r���]b�Q��x��\0��?�\rg�A6��!�, �Ie�o;�G����e�	?��ъ\n�U��jo���C���\$9��56�*|��+q��4c���\0�%���<!a,fTXz��!�}�7D�ɊIvԅ\\=K����٬^%����<����{�<�=5?��� ��m�w*w��os����R���̷rBU_ɍwo������Y���M����z;�ޠwg����yK����y��?};�߾�w羱���{�<��w�����>�u jlS��/B�A>,�gy��yWiiK6ER���ɥw_ٚc1	�4D�F�c�z����5'�9���B!�ߗZj?�װ�.s�X<}E���u�^A�_���wZ��\r5;����n�l��b7�+�b}�ul�@��S�\0��6?Q�<>	�0�CIi�!L\0�w��q����ce�G�g�+ϫ\r��'<����!��`�r�'���Ry�f��om���8���������)4�B{@c/P�Ƃ�2k�hJ�i�	\\�\$3p���e�1�I��\"�cH��N��#ҝ��m�QPĕ�o���]�B2s���hǩ�o��1�ա��a#	� �0݈ ab�h�撄�~�a�9,Æ\ny�c����I�)���F;�i���5�MF��+���{j��>g/������yOߧ�!�mCnF���@��\r�\0�����t�{�G�ϐ�� Cz`�m�/���\0h�ǚ?����5��@[�/������>Z��|܍���~9�}_Q�����%��X�%��\0`Ko���ꣴϾ��`:���,�'���Q|�Se�8Q������W]��>�����W\0_����H�2};�_5��0��Kc���d����O��X�m���np����?:����y�/�������?M�ߪ�{9Mp��I�Qݎ|C�X�/z�??�~؆Ē� ����?�i�������_����>��O�7�_����?,�C|d~��f4����	��_ w���M���;�?��g�>]�o�������������o��0��h������#?F��������B4��k�@�>}\0{���?�\0��O�@8��\"4�#���������hA0��\0000�to����`9������@L�t�2���Є@Z�&���	��W�n���������>��ｂ���Ϛ���o@�������<4�����5���P*��\r�A\n��o����p;���� �a4\r�1��(\"!g@��,���PJ���p]�8A2����>���N��,*�&c�>D���Y>�k���?lh�	���(�#�����T��B��\0\\\n0O>8��&x�*���c?%dpa>]\0�ϟ]<Pa���xF�Py�eb�@�\no�A��E�L\n�cǹ�\0[�Pq�p�d�eA�Pg@�<z���*���g�8�߂��	� :��	ϕ��,��)����/%�H�iKO9��L��<�_�Pu�@�Ѐ8\$4 e~�<! ��\$�\0000�O�!'i�(1�� >�");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO��er�x�9�*ź��n3�\rщv�C��`���2G%�Y�����1��f���Ȃl��1�\ny�*pC\r\$�n�T��3=\\�r9O\"�	��l<�\r�\\��I,�s\nA��eh+M�!�q0��f�`(�N{c��+w���Y��p٧3�3��+I��j�����k��n�q���zi#^r�����3���[��o;��(��6�#�Ґ��\":cz>ߣC2v�CX�<�P��c*5\n���/�P97�|F��c0�����!���!���!��\nZ%�ć#CH�!��r8�\$���,�Rܔ2���^0��@�2��(�88P/��݄�\\�\$La\\�;c�H��HX���\nʃt���8A<�sZ�*�;I��3��@�2<���!A8G<�j�-K�({*\r��a1���N4Tc\"\\�!=1^���M9O�:�;j��\r�X��L#H�7�#Tݪ/-���p�;�B \n�2!���t]apΎ��\0R�C�v�M�I,\r���\0Hv��?kT�4����uٱ�;&���+&���\r�X���bu4ݡi88�2B�/⃖4���N8A�A)52������2��s�8�5���p�WC@�:�t�㾴�e��h\"#8_��cp^��I]OH��:zd�3g�(���Ök��\\6����2�ږ��i��7���]\r�xO�n�p�<��p�Q�U�n��|@���#G3��8bA��6�2�67%#�\\8\r��2�c\r�ݟk��.(�	��-�J;��� ��L�� ���W��㧓ѥɤ����n��ҧ���M��9ZНs]�z����y^[��4-�U\0ta��62^��.`���.C�j�[ᄠ% Q\0`d�M8�����\$O0`4���\n\0a\rA�<�@����\r!�:�BA�9�?h>�Ǻ��~̌�6Ȉh�=�-�A7X��և\\�\r��Q<蚧q�'!XΓ2�T �!�D\r��,K�\"�%�H�qR\r�̠��C =�������<c�\n#<�5�M� �E��y�������o\"�cJKL2�&��eR��W�AΐTw�ё;�J���\\`)5��ޜB�qhT3��R	�'\r+\":�8��tV�A�+]��S72��Y�F��Z85�c,���J��/+S�nBpoW�d��\"�Q��a�ZKp�ާy\$�����4�I�@L'@�xC�df�~}Q*�ҺA��Q�\"B�*2\0�.��kF�\"\r��� �o�\\�Ԣ���VijY��M��O�\$��2�ThH����0XH�5~kL���T*:~P��2�t���B\0�Y������j�vD�s.�9�s��̤�P�*x���b�o����P�\$�W/�*��z';��\$�*����d�m�Ã�'b\r�n%��47W�-�������K���@<�g�èbB��[7�\\�|�VdR��6leQ�`(Ԣ,�d��8\r�]S:?�1�`��Y�`�A�ғ%��ZkQ�sM�*���{`�J*�w��ӊ>�վ�D���>�eӾ�\"�t+po������W\$����Q�@��3t`����-k7g��]��l��E��^dW>nv�t�lzPH��FvW�V\n�h;��B�D�س/�:J��\\�+ %�����]��ъ��wa�ݫ���=��X��N�/��w�J�_[�t)5���QR2l�-:�Y9�&l R;�u#S	� ht�k�E!l���>SH��X<,��O�YyЃ%L�]\0�	��^�dw�3�,Sc�Qt�e=�M:4���2]��P�T�s��n:��u>�/�d�� ��a�'%����qҨ&@֐���H�G�@w8p����΁�Z\n��{�[�t2���a��>	�w�J�^+u~�o��µXkզBZk˱�X=��0>�t��lŃ)Wb�ܦ��'�A�,��m�Y�,�A���e��#V��+�n1I����E�+[����[��-R�mK9��~���L�-3O���`_0s���L;�����]�6��|��h�V�T:��ޞerM��a�\$~e�9�>����Д�\r��\\���J1Ú���%�=0{�	����|ޗtڼ�=���Q�|\0?��[g@u?ɝ|��4�*��c-7�4\ri'^���n;�������(���{K�h�nf���Zϝ}l�����]\r��pJ>�,gp{�;�\0��u)��s�N�'����H��C9M5��*��`�k�㬎����AhY��*����jJ�ǅPN+^� D�*��À���D��P���LQ`O&��\0�}�\$���6�Zn>��0� �e��\n��	�trp!�hV�'Py�^�*|r%|\nr\r#���@w����T.Rv�8�j�\nmB���p�� �Y0�Ϣ�m\0�@P\r8�Y\rG��d�	�QG�P%E�/@]\r���{\0�Q����bR M\rF��|��%0SDr�����f/����\":�mo�ރ�%�@�3H�x\0�l\0���	��W����\n�8\r\0}�@�D��`#�t��.�jEoDrǢlb����t�f4�0���%�0���k�z2\r� �W@�%\r\n~1��X����D2!��O�*���{0<E��k*m�0ı���|\r\n�^i��� ��!.�r � ��������f��Ĭ��+:��ŋJ�B5\$L���P���LĂ�� Z@����`^P�L%5%jp�H�W��on��kA#&���8��<K6�/����̏������XWe+&�%���c&rj��'%�x�����nK�2�2ֶ�l��*�.�r��΢���*�\r+jp�Bg�{ ���0�%1(���Z�`Q#�Ԏ�n*h��v�B����\\F\n�W�r f\$�93�G4%d�b�:JZ!�,��_��f%2��6s*F���Һ�EQ�q~��`ts�Ҁ���(�`�\r���#�R����R�r��X��:R�)�A*3�\$l�*ν:\"Xl��tbK�-��O>R�-�d��=��\$S�\$�2��}7Sf��[�}\"@�]�[6S|SE_>�q-�@z`�;�0��ƻ��C�*��[���{D��jC\nf�s�P�6'���ȕ QE���N\\%r�o�7o�G+dW4A*��#TqE�f��%�D�Z�3��2.��Rk��z@��@�E�D�`C�V!C��ŕ\0���I�)38��M3�@�3L��ZB�1F@L�h~G�1M���6��4�Xє�}ƞf�ˢIN��34��X�Btd�8\nbtN��Qb;�ܑD��L�\0��\"\n����V��6��]U�cVf���D`�M�6�O4�4sJ��55�5�\\x	�<5[F�ߵy7m�)@SV��Ğ#�x��8 ոы��`�\\`�-�v2���p���+v���U��L�xY.����\0005(�@��ⰵ[U@#�VJuX4�u_�\"JO(Dt�_	5s�^���������5�^�^V�I��\rg&]��\r\"ZCI�6��#��\r��ܓ��]7���q�0��6}o���`u��ab(�X�D�f�M�N)�V�UUF�о��=jSWi�\"\\B1Ğ�E0� �amP��&<�O_�L���.c�1Z*��R\$�h���mv�[v>ݭ�p����(��0����cP�om\0R��p�&�w+KQ�s6�}5[s�J���2��/���O �V*)�R�.Du33�F\r�;��v4���H�	_!��2��k����+��%�:�_,�eo��F��AJ�O�\"%�\n�k5`z %|�%�Ϋg|��}l�v2n7�~\0�	�YRH��@��r��xN-Jp\0���f#��@ˀmv�x��\r���2WMO/�\nD��7�}2���VW�W��wɀ7����H�k���]�\$�Mz\\�e�.f�RZ�a�B���Qd�KZ��vt���w4�\0�Z@�	��Bc;�b��>�B�	3m�n\n�o��J3��k�(܍���\"�yG\$:\r�ņ�ݎ��G6�ɲJ��y��Q�\\Q��if�����(�m)/r�\$�J�/�H�]*���g�ZOD�Ѭ��]1�g22������f�=HT��]N�&���M\0�[8x�ȮE��8&L�Vm�v����j�ט�F��\\��	���&s�@Q� \\\"�b��	��\rBs�Iw�	�Yɜ�N �7�C/&٫`�\n\n��[k���*A���T�V*UZtz{�.��y�S���#�3�ipzW@yC\nKT��1@|�z#���_CJz(B�,V�(K�_��dO���P�@X��t�Ѕ��c;�WZzW�_٠�\0ފ�CF�xR �	�\n������P�A��&������,�pfV|@N�\"�\$�[�i����������Z�\0Zd\\\"�|�W`��]��tz�o\$�\0[����u�e���ə�bhU-��,�r �Lk8��֫�V&�al����d��2;	�'-��Jyu��a���\0����a��{s�[9V\0��F��R �VB0S;D�>L4�&�ZHO1�\0�wg��S�tK��R�z���i��+�3�w��z�X�]�(G\$����D+�tչ�(#����oc�:	��Y6�\0��&��	@�	���)��!����w���# t�x�ND�����)��C��FZ�p��a��*F�b�	��ͼ����ģ�����Si/S�!��z�UH*�4����0�K�-�/���-k`�n�Li�J�~�w�Jn��\"�`�=��V�3Oį8t�>��vo��E.��Rz`��p�P���E\\��ɧ�3L�l�ѥs]T���oV��\n��	*�\r�@7)��D�m�0W�5Ӏ��ǰ�w��b���|	��JV����\"�ur\r�&N0N�B�d��d�8�D��_ͫ�^T��H#]�d�+�v�~�U,�PR%�����x���fA��C��m����͸����c��yŜD)���uH���p�p�^u\0�����}�{ѡ�\rg�s�QM�Y�2j�\r�|0\0X��@q���I`��5F�6�N��V@ӔsE�p���#\r�P�T��DeW�ؼ񛭁��z!û�:�DMV(��~X���9�\0�@���40N�ܽ~�Q�[T���e�qSv\"�\"h�\0R-�hZ�d����F5�P��`�9�D&xs9W֗5Er@o�wkb�1��PO-O�OxlH�D6/ֿ�m�ޠ��3�7T��K�~54�	�p#�I�>YIN\\5���NӃ����M��pr&�G�xM�sq����.F���8�Cs�� h�e5������*�b�)Sڪ��̭�e�0�-X� {�5|�i�֢a��ȕ6z�޽��/Y���ێM� ƃ� �\nR*8r o� @7�8Bf�z�K�r���A\$˰	p�\0?���d�k�|45}�A����ɶ�W��J�2k Gi\0\"����d���8�\0�>m��� `8�w�7�o4�cGh��Q�(퀨�8@\$<\0p��0���L�eX+�Ja�{�B��h��8�Cy���P2��Ӯ�*�EH�2���DqS�ۘ�p�0�I���k�`��S�\n�:��B�7����{-����`����6�A�W�ܖ\r�p�W#���?���{\0������cD��[<����f�--�pԌ�*B�]�nW��^��R70\r�+N�GN�\$(\0�#+y�@�@iD(8@\r�h��H�He����zz�{1���h��W1F�Who&aɜ�d6���jw�������`h�{v`RE�\nj���`�ܷ����*���ʸ}�Y��	\rY�H�6�#\0�廆��a�� Q�HEl4�d���p��#�������o�br+_)\r`��!�|dQ�>��=Qʡ��ζ�EOB'�>�P��Ӷ� A\rnK�i�� 	�����	�%<	�o;�S�@�!	�x��:���A�+\\1d\$�jO��7�%�	�/����gu�z*�G�H�5\"8��,�]raq���/�h��#����\$ /tn��8y��-�O���H�b���<�Z�!���1��`�.(uo����|`GːS��BaM	ڂ9ƞ�D@���1�B�tD��ʡ@?o�(H��qC��8E�TcncR��6�N%�rHj��2G\0�a��q �r��z9b>(P��x��<��)�x#�8�誹t���h�2v��Wo2U���t��+=�l#���j�D�	0����&R�c�\$�*̑-Z`��\r��;�|A�p�=1�	1����ƈ�bEv(^�X�P2=\0}�W���G�<���G�����R�#P�Hܮr9	��Y��!�LB���4�NC�Z��IC���MLm��,�f@eY�x�BS(�+��<4Y�)-�\r�z?\$���\"\"�� 6�E�\r)z���@ȑ��r����*��J�윋��%\$�e�J���\0A�\$ڰ/5��B0S���x��I�Q)�<��4YS�&�{��b�+IG=>�\r�PY`Z�D�`��U����F1���4d8X(����C%�`�㜭0�I\$�7W�pǁ,��Ac���&Ԍ�p\$�:�>]�.�VY��\$p� ��]��`�;��e�\0�0�\n��K+�@DL�S��r(on�M\0@9��%�\"�WS�\"���� 䥙�ٍ�ػj�_J-��rʜ���5�\\�2�5>Ze\"0��%9y��^�WMax&a)D�L���2Q����t?�=,�/o�f�3I�J�\$\r;���7�}�\r�W�@�Ұ�M|\r�Y���]5���\\*s:��FV!���kن�R���L3L�	��52�M�sb�\$����7�\0l�y���&� 9�|m!��0J��4��TSd���G���nK�V:l�D'/��:Zs��\n��y�%��i����,@ҲL��j1<��3Ĩ�D2/;��'Pݻ����`���qKȰ�f�I�L� Dݬ�4�3 ��OH�J�	q�&�����X��!��r)F�Xx���^QwOP��h��՞-_�>�a����(	��x%��K�b�<�E�j7�������hHt�`�.r�P���x��\"{\0006CVQE�&��>�ޅ�w����e'?B�9x�>:\"�73���xT\0e����j	��[t�Ҝ\"�(\\K�e�z�r����e> ���\0002�hʇ��X�a<�JtU�z`�達?��#�����2-��4hFY|C��\"M�yƔKd ���E�7���+(U�ʖX�� /D���)�\"����بމjoh�Fz4�t���D׌�G��RZ�ć�ȿ\0�FV4Q�6v�b�i=G�;Ϭ�k�d+\n>�E��\0�2f{����!J��Q�J�ؘ9��(2�#\\Z��,��Qܥ�3?8`�	bwR6��\n*�㋀�ƒ�(t��L*�S�d�\0x�)�(�*�wH]7O�N�v(Гdg�q	\nLp��L�N��H@�1����M �		n��z���e4!!	��'槝-t���AQP���L,����7��\\�i����^�\$�,�|�Z��(S9���\n* +��T�D�z?(T�>��L��æ��R����\$�zдi̼W�ͨ�Ds�{)�@�����	v�P��g�qIVҨ����\n )�!�8|\$pZ�*�!7A����N��j�NW����U���Q���)�eF�UA�S�x\0[N���2���X :S�T�~�S*T4	�3��]9�F���]:�KUg;��*Ay�a��1j|8Ϋ����I�MR��Vh7uU���r,�h�%<q�R@N9�ާ�k�	�B|�����8��r������DР@\"�ɋ�z\r������O�_���Q�\0\0���|�]�f�\nz�����UeH�Ą/k+�TF?��*03�!�\0��I���t	f\0(S�U��ZA�F��1\0��k�]��WZN�Q��܂���%��x1���'��!-,�Ƕvzg��#�Gh�;f�PH�9Bj�u�\n�A�VR����1K+�MN!��Sμ��Y��vdZ\\,���g٨�����\"}W��Yɵ�t�P��g�,�����	\0b�-�hB/@�̎�/�M��J���Y\0����)\n��I�?v�	��Ȕ1��\$�(�w\r+�n ��s�s�QfQ�O�P�.D���bV\0-�J<�i;[���=#���n,j?)�\"���lYL.����A::������BxOF7����`���d��}�}=�i)@к��\$ q˷(y%��huzb2�3Ƨ��.�-h�oO����\0`���VZ��&y�t9C���鋭Z��ґ�Z!�X�U����.k��V#8�G�}�Q���u8cΫt�bE>�v��{@{QP]<�ary��j\\��\$j�x�nc6k�;qs�T���K�����jJ���n\\C��{���`g�6�5�Rk�t����s�|@�_0΅5:B�3����rѡ�&�㴸�\0����&�׈�����ԡ��SXʕ�G�m�ʶWr,j�q\0\$޺sW�P�.A\n4�9(u�.���l�V�Ju�Ԍ�+�A�uC�>hl6��2���G�e���N��n�=�'���~��Þ��PҀ�%0z�u��r�\0��9uE�s\"���\\�ט���^���(3ՑS%<+�9��Ծ����\0���~'̞�֓<+�,i�:��@��N���\$�o������� �]������Z�!��]�n,��x��>_�f��W\0006��%�}I�\nh߀w�����ǃ -��H@_�Vi�����{���R��^�۔}5�b,!5���H��p/��k<��<�jh|i��k��hLv݄\n�`�[���WC6��z\n�g��r��u=��!zCţ���e#��nj��\0`^;=E�*@�y�% ��LQe���2�A�1,��C�ix�t����G�]q�O(����\n�V9dr�D'5@x\$�r6��;\"ǣ���7�\0M0ņH_#�c�pn>��<aa�q@g�2��lm-��������8��?8��7p����>��ji���N�\$#E/�0��s\n�B\r�*��z��oyn[Ι�� 6�a����g8�qC��⼜�I�rNF�ȫ�1��70�����/i(�B�0����Z��(��+S�J�,��91/Y+jxӱF���A��k�f�Jee\r�Cͳrz�m���h@9�O�� ؝��GK�Ad���OH���=���<&`��K�PA�!WO;-�X�L��m�Kz�7-e[u��p�q���o/�`�C����KX�f�i��Y7=�M�/�F�R�۔T�d��Y\"=`�1�k�1Տh�\r���f@N��z�(@����	h�\0�����I�}PJKr���pR`x������fo���(A��[��19�(&jo<��I@p	@�����,y�	nIs�^Ўѫ:Y��vc���؏9q.C��8�bW��V?��҅�9�\$u�@5#S(4Y���K���6�!��N6<��|v1��3ʊ:��!����`��M��l����f`�Z��J=��GX�Y)_l�А�T�)P��`�%��:�!Z\"lYS�Uؤ(��Y1Z�니rv)F`�K~=Y>���S���c����!l���D����BrF\$��RA:�\\�P�4�V�R6<�O�S�_BCS+����'V��2T#Lc�F�NBD%�G�W�nR�S����I��\n'k�0���O��Ў����8rݯAS�?��xm��yv���a�b��Ͱ�,��ЅA������]pJ\\\\�Xi���Eu��B)���Z@Ώ \"��gg0{��n��'APR��٨v�~�0R�w쀱\"�������H�J���Ζ�\\�\r}i?�Ғ:��2���g��{I�3)��B��͙Z�s��`.�#2�vt�X�IGU>`)�%���(|�f<Κ_�ޯ���_G�<��_ ˟������[:�6G8��l�#J(��JC���`���wF�w\"b�!,��!�r�@�K(���\n@AsV��S�ֹ�4�_\ns٠eڋj��)&�3�{��k���Q���G�c��X^�L{�C\n�m����A��D��1O?(��(�����2\"UL��+#o��@���X�\0�٭���^n_p�eQ˙X}%��*��e�m�{�GN��Xl�q�]R\\Z�v!�) ���xd΀,�cK��鮇�m���I~����K�{+��Gݥ�=@Q��,1!aEOc��#6<u��rB�\n�Ȳ��dH�t����	�{C�<x3���H��1��K�wB�\0��u����'ӆQ�^���򕥂�i�rRv�Vɷ�lS�.O)����[��xS�t���c)���k�B��+��v���B��w�.�wC���2���2d�.H��p+a\\H��[�\$}nNN7��H�.�S\r�ȒT���w�	*H�g\\��\$�,�:KBOx��>����5����Ӷ����u2��n��`��Yq�D���xwMB�n�2>���G�ڄ����YaK�w(2`����w����1m�-:�&LD8�U��8l��\\<���	��z�a����:,��K'�%7:���M����U[���*;K���j�;/wG���\n���^�eV'��,��;��B6�G�1��OKW����(i�X\np�Cکc6�^��㷀=�^ûcQ��Rp`\$	�D(\0D�>{�ET�c��I\r{���\$o�R	�ZZ�4*��??�+j���n��Q`����X�3�	\$���M�\n׉w�\"d�W���~@�'�I�᭫�0+-��w����y�6�vȽ'�Ԇ:Y)Y0\0�*)?'��Ǟv����fI�\n��z�9�.�b��!�c�E�[��F麙ks�}��Bv�g�5�V���,)J\$��j�Z�J�\$�Y��ח9�\0�\n����.^J��ڋ�b��mI0:g��������˗ATP�I�]~!��;D�����	�z��<P�Q>�m���`��?%Y��T\n\0D\0�\0'���H@0`�<׭�10�(�m�-��ɞ7A\0�~�~ꁡĤ?t�hє.w�%)0	#c����\"�c����jfW��\0\0p��C���kC��8��85+i:��[�8�b��l�[\"����5S�y\0�����*�Q�6V�s�9��7!�;\"��c�)�O�Q,��Ա��\r�7�,*�0�aQ�u?�_C|�������R(o(��<j(��Tv��\r|_\"�3��m��S7D�!׸�h�|���(�&�@:�	\"-ގ��&Mu;�,�bк=p�>A6ɭ���7���- WW9�O,�o'�v2�<�3\0���h��@`� 3TX�Ϛ|�\"FC_��~x����`��'f�Q-4�����/�`'���=A�\$>��`P��_G(���E���&/J�I�v�'�m餧zpޞFo�	�/[��i�؋�G*���y�(�<��7q�Y�.�眪��B���\r�l�r\nUnƧ��T>�������	�Q���_�|����K��8�ډ�e��_��xz�x�L���p14��d����U#4t�K���\$�!����p�w����Zx��_����i5T?}��C�{�����h/Gzj\$.B�Ҩ�=#�Ϗ|��*����I��w/��a�x`*��*���]����>a?'}FJS���ԖA0��'�����ʟ�0:63���л��n'��U/�r�|=slb0�\0W�rB�ʤ���@T��~\$����H�����	��D\\���-���(��ᩖB�M���z+�%�(��i��㹃�I���5/�.y/���\$�{Q}p�ܻdI�\\�Վ�B�\0V0�B�9�{T\$n�8\$Z�e�Pĳ���%9�&���V��b�x}g\"%h���*ٸvOw�˾�/�o�L,���=��V��5Bg� ϶�3��>�~�`\nxi�\"��v@�����nף�ϳyac�G�'%[��4`n��47!5�ހr����ɉ��>z�(Y�t��0���V���P�ZXT`2�~Cl���[o�n�t8jB\0d�\0000��V��g�����@V!�h\0006d<��=[�W�����f�@pb��a��ټ�s;���G<�~a�?�N�L����\"(���?�%�x#�7�|S��O�Ɠ)�B4��+��*�!��)6#�+?'���(X�����JO\0��");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0��F����==��FS	��_6MƳ���r:�E�CI��o:�C��Xc��\r�؄J(:=�E���a28�x�?�'�i�SANN���xs�NB��Vl0���S	��Ul�(D|҄��P��>�E�㩶yHch��-3Eb�� �b��pE�p�9.����~\n�?Kb�iw|�`��d.�x8EN��!��2��3���\r���Y���y6GFmY�8o7\n\r�0��\0�Dbc�!�Q7Шd8���~��N)�Eг`�Ns��`�S)�O���/�<�x�9�o�����3n��2�!r�:;�+�9�CȨ���\n<�`��b�\\�?�`�4\r#`�<�Be�B#�N ��\r.D`��j�4���p�ar��㢺�>�8�\$�c��1�c���c����{n7����A�N�RLi\r1���!�(�j´�+��62�X�8+����.\r����!x���h�'��6S�\0R����O�\n��1(W0���7q��:N�E:68n+��մ5_(�s�\r��/m�6P�@�EQ���9\n�V-���\"�.:�J��8we�q�|؇�X�]��Y X�e�zW�� �7��Z1��hQf��u�j�4Z{p\\AU�J<��k��@�ɍ��@�}&���L7U�wuYh��2��@�u� P�7�A�h����3Û��XEͅZ�]�l�@Mplv�)� ��HW���y>�Y�-�Y��/�������hC�[*��F�#~�!�`�\r#0P�C˝�f������\\���^�%B<�\\�f�ޱ�����&/�O��L\\jF��jZ�1�\\:ƴ>�N��XaF�A�������f�h{\"s\n�64������?�8�^p�\"띰�ȸ\\�e(�P�N��q[g��r�&�}Ph���W��*��r_s�P�h���\n���om������#���.�\0@�pdW �\$Һ�Q۽Tl0� ��HdH�)��ۏ��)P���H�g��U����B�e\r�t:��\0)\"�t�,�����[�(D�O\nR8!�Ƭ֚��lA�V��4�h��Sq<��@}���gK�]���]�=90��'����wA<����a�~��W��D|A���2�X�U2��yŊ��=�p)�\0P	�s��n�3�r�f\0�F���v��G��I@�%���+��_I`����\r.��N���KI�[�ʖSJ���aUf�Sz���M��%��\"Q|9��Bc�a�q\0�8�#�<a��:z1Uf��>�Z�l������e5#U@iUG��n�%Ұs���;gxL�pP�?B��Q�\\�b��龒Q�=7�:��ݡQ�\r:�t�:y(� �\n�d)���\n�X;����CaA�\r���P�GH�!���@�9\n\nAl~H���V\ns��ի�Ư�bBr���������3�\r�P�%�ф\r}b/�Α\$�5�P�C�\"w�B_��U�gAt��夅�^Q��U���j���Bvh졄4�)��+�)<�j^�<L��4U*���Bg�����*n�ʖ�-����	9O\$��طzyM�3�\\9���.o�����E(i������7	tߚ�-&�\nj!\r��y�y�D1g���]��yR�7\"������~����)TZ0E9M�YZtXe!�f�@�{Ȭyl	8�;���R{��8�Į�e�+UL�'�F�1���8PE5-	�_!�7��[2�J��;�HR��ǹ�8p痲݇@��0,ծpsK0\r�4��\$sJ���4�DZ��I��'\$cL�R��MpY&����i�z3G�zҚJ%��P�-��[�/x�T�{p��z�C�v���:�V'�\\��KJa��M�&���Ӿ\"�e�o^Q+h^��iT��1�OR�l�,5[ݘ\$��)��jLƁU`�S�`Z^�|��r�=��n登��TU	1Hyk��t+\0v�D�\r	<��ƙ��jG���t�*3%k�YܲT*�|\"C��lhE�(�\r�8r��{��0����D�_��.6и�;����rBj�O'ۜ���>\$��`^6��9�#����4X��mh8:��c��0��;�/ԉ����;�\\'(��t�'+�����̷�^�]��N�v��#�,�v���O�i�ϖ�>��<S�A\\�\\��!�3*tl`�u�\0p'�7�P�9�bs�{�v�{��7�\"{��r�a�(�^��E����g��/���U�9g���/��`�\nL\n�)���(A�a�\" ���	�&�P��@O\n師0�(M&�FJ'�! �0�<�H�������*�|��*�OZ�m*n/b�/�������.��o\0��dn�)����i�:R���P2�m�\0/v�OX���Fʳψ���\"�����0�0�����0b��gj��\$�n�0}�	�@�=MƂ0n�P�/p�ot������.�̽�g\0�)o�\n0���\rF����b�i��o}\n�̯�	NQ�'�x�Fa�J���L������\r��\r����0��'��d	oep��4D��ʐ�q(~�� �\r�E��pr�QVFH�l��Kj���N&�j!�H`�_bh\r1���n!�Ɏ�z�����\\��\r���`V_k��\"\\ׂ'V��\0ʾ`AC������V�`\r%�����\r����k@N����B�횙� �!�\n�\0Z�6�\$d��,%�%la�H�\n�#�S\$!\$@��2���I\$r�{!��J�2H�ZM\\��hb,�'||cj~g�r�`�ļ�\$���+�A1�E���� <�L��\$�Y%-FD��d�L焳��\n@�bVf�;2_(��L�п��<%@ڜ,\"�d��N�er�\0�`��Z��4�'ld9-�#`��Ŗ����j6�ƣ�v���N�͐f��@܆�&�B\$�(�Z&���278I ��P\rk\\���2`�\rdLb@E��2`P( B'�����0�&��{���:��dB�1�^؉*\r\0c<K�|�5sZ�`���O3�5=@�5�C>@�W*	=\0N<g�6s67Sm7u?	{<&L�.3~D��\rŚ�x��),r�in�/��O\0o{0k�]3>m��1\0�I@�9T34+ԙ@e�GFMC�\rE3�Etm!�#1�D @�H(��n ��<g,V`R]@����3Cr7s~�GI�i@\0v��5\rV�'������P��\r�\$<b�%(�Dd��PW����b�fO �x\0�} ��lb�&�vj4�LS��ִԶ5&dsF M�4��\".H�M0�1uL�\"��/J`�{�����xǐYu*\"U.I53Q�3Q��J��g��5�s���&jь��u�٭ЪGQMTmGB�tl-c�*��\r��Z7���*hs/RUV����B�Nˈ�����Ԋ�i�Lk�.���t�龩�rYi���-S��3�\\�T�OM^�G>�ZQj���\"���i��MsS�S\$Ib	f���u����:�SB|i��Y¦��8	v�#�D�4`��.��^�H�M�_ռ�u��U�z`Z�J	e��@Ce��a�\"m�b�6ԯJR���T�?ԣXMZ��І��p����Qv�j�jV�{���C�\r��7�Tʞ� ��5{P��]�\r�?Q�AA������2񾠓V)Ji��-N99f�l Jm��;u�@�<F�Ѡ�e�j��Ħ�I�<+CW@�����Z�l�1�<2�iF�7`KG�~L&+N��YtWH飑w	����l��s'g��q+L�zbiz���Ţ�.Њ�zW�� �zd�W����(�y)v�E4,\0�\"d��\$B�{��!)1U�5bp#�}m=��@�w�	P\0�\r�����`O|���	�ɍ����Y��JՂ�E��Ou�_�\n`F`�}M�.#1��f�*�ա��  �z�uc���� xf�8kZR�s2ʂ-���Z2�+�ʷ�(�sU�cD�ѷ���X!��u�&-vP�ر\0'L�X �L����o	��>�Վ�\r@�P�\rxF��E��ȭ�%����=5N֜��?�7�N�Å�w�`�hX�98 �����q��z��d%6̂t�/������L��l��,�Ka�N~�����,�'�ǀM\rf9�w��!x��x[�ϑ�G�8;�xA��-I�&5\$�D\$���%��xѬ���´���]����&o�-3�9�L��z���y6�;u�zZ ��8�_�ɐx\0D?�X7����y�OY.#3�8��ǀ�e�Q�=؀*��G�wm ���Y�����]YOY�F���)�z#\$e��)�/�z?�z;����^��F�Zg�����������`^�e����#�������?��e��M��3u�偃0�>�\"?��@חXv�\"������*Ԣ\r6v~��OV~�&ר�^g���đٞ�'��f6:-Z~��O6;zx��;&!�+{9M�ٳd� \r,9���W��ݭ:�\r�ٜ��@睂+��]��-�[g��ۇ[s�[i��i�q��y��x�+�|7�{7�|w�}����E��W��Wk�|J؁��xm��q xwyj���#��e��(�������ߞþ��� {��ڏ�y���M���@��ɂ��Y�(g͚-��������J(���@�;�y�#S���Y��p@�%�s��o�9;�������+��	�;����ZNٯº��� k�V��u�[�x��|q��ON?���	�`u��6�|�|X����س|O�x!�:���ϗY]�����c���\r�h�9n�������8'������\rS.1��USȸ��X��+��z]ɵ��?����C�\r��\\����\$�`��)U�|ˤ|Ѩx'՜����<�̙e�|�ͳ����L���M�y�(ۧ�l�к�O]{Ѿ�FD���}�yu��Ē�,XL\\�x��;U��Wt�v��\\OxWJ9Ȓ�R5�WiMi[�K��f(\0�dĚ�迩�\r�M����7�;��������6�KʦI�\r���xv\r�V3���ɱ.��R������|��^2�^0߾\$�Q��[�D��ܣ�>1'^X~t�1\"6L���+��A��e�����I��~����@����pM>�m<��SK��-H���T76�SMfg�=��GPʰ�P�\r��>�����2Sb\$�C[���(�)��%Q#G`u��Gwp\rk�Ke�zhj��zi(��rO�������T=�7���~�4\"ef�~�d���V�Z���U�-�b'V�J�Z7���)T��8.<�RM�\$�����'�by�\n5����_��w����U�`ei޿J�b�g�u�S��?��`���+��� M�g�7`���\0�_�-���_��?�F�\0����X���[��J�8&~D#��{P���4ܗ��\"�\0��������@ғ��\0F ?*��^��w�О:���u��3xK�^�w���߯�y[Ԟ(���#�/zr_�g��?�\0?�1wMR&M���?�St�T]ݴG�:I����)��B�� v����1�<�t��6�:�W{���x:=��ޚ��:�!!\0x�����q&��0}z\"]��o�z���j�w�����6��J�P۞[\\ }��`S�\0�qHM�/7B��P���]FT��8S5�/I�\r�\n ��O�0aQ\n�>�2�j�;=ڬ�dA=�p�VL)X�\n¦`e\$�TƦQJ����lJ����y�I�	�:����B�bP���Z��n����U;>_�\n	�����`��uM򌂂�֍m����Lw�B\0\\b8�M��[z��&�1�\0�	�\r�T������+\\�3�Plb4-)%Wd#\n��r��MX\"ϡ�(Ei11(b`@f����S���j�D��bf�}�r����D�R1���b��A��Iy\"�Wv��gC�I�J8z\"P\\i�\\m~ZR��v�1ZB5I��i@x����-�uM\njK�U�h\$o��JϤ!�L\"#p7\0� P�\0�D�\$	�GK4e��\$�\nG�?�3�EAJF4�Ip\0��F�4��<f@� %q�<k�w��	�LOp\0�x��(	�G>�@�����9\0T����GB7�-�����G:<Q��#���Ǵ�1�&tz��0*J=�'�J>���8q��Х���	�O��X�F��Q�,����\"9��p�*�66A'�,y��IF�R��T���\"��H�R�!�j#kyF���e��z�����G\0�p��aJ`C�i�@�T�|\n�Ix�K\"��*��Tk\$c��ƔaAh��!�\"�E\0O�d�Sx�\0T	�\0���!F�\n�U�|�#S&		IvL\"����\$h���EA�N\$�%%�/\nP�1���{��) <���L���-R1��6���<�@O*\0J@q��Ԫ#�@ǵ0\$t�|�]�`��ĊA]���Pᑀ�C�p\\pҤ\0���7���@9�b�m�r�o�C+�]�Jr�f��\r�)d�����^h�I\\�. g��>���8���'�H�f�rJ�[r�o���.�v���#�#yR�+�y��^����F\0᱁�]!ɕ�ޔ++�_�,�\0<@�M-�2W���R,c���e2�*@\0�P ��c�a0�\\P���O���`I_2Qs\$�w��=:�z\0)�`�h�������\nJ@@ʫ�\0�� 6qT��4J%�N-�m����.ɋ%*cn��N�6\"\r͑�����f�A���p�MۀI7\0�M�>lO�4�S	7�c���\"�ߧ\0�6�ps�����y.��	���RK��PAo1F�tI�b*��<���@�7�˂p,�0N��:��N�m�,�xO%�!��v����gz(�M���I��	��~y���h\0U:��OZyA8�<2����us�~l���E�O�0��0]'�>��ɍ�:���;�/��w�����'~3GΖ~ӭ����c.	���vT\0c�t'�;P�\$�\$����-�s��e|�!�@d�Obw��c��'�@`P\"x����0O�5�/|�U{:b�R\"�0�шk���`BD�\nk�P��c��4�^ p6S`��\$�f;�7�?ls��߆gD�'4Xja	A��E%�	86b�:qr\r�]C8�c�F\n'ьf_9�%(��*�~��iS����@(85�T��[��Jڍ4�I�l=��Q�\$d��h�@D	-��!�_]��H�Ɗ�k6:���\\M-����\r�FJ>\n.��q�eG�5QZ����' ɢ���ہ0��zP��#������r���t����ˎ��<Q��T��3�D\\����pOE�%)77�Wt�[��@����\$F)�5qG0�-�W�v�`�*)Rr��=9qE*K\$g	��A!�PjBT:�K���!��H� R0?�6�yA)B@:Q�8B+J�5U]`�Ҭ��:���*%Ip9�̀�`KcQ�Q.B��Ltb��yJ�E�T��7���Am�䢕Ku:��Sji� 5.q%LiF��Tr��i��K�Ҩz�55T%U��U�IՂ���Y\"\nS�m���x��Ch�NZ�UZ���( B��\$Y�V��u@蔻����|	�\$\0�\0�oZw2Ҁx2���k\$�*I6I�n�����I,��QU4�\n��).�Q���aI�]����L�h\"�f���>�:Z�>L�`n�ض��7�VLZu��e��X����B���B�����Z`;���J�]�����S8��f \nڶ�#\$�jM(��ޡ����a�G��+A�!�xL/\0)	C�\n�W@�4�����۩� ��RZ����=���8�`�8~�h��P ��\r�	���D-FyX�+�f�QSj+X�|��9-��s�x�����+�V�cbp쿔o6H�q�����@.��l�8g�YM��WMP��U��YL�3Pa�H2�9��:�a�`��d\0�&�Y��Y0٘��S�-��%;/�T�BS�P�%f������@�F�(�֍*�q +[�Z:�QY\0޴�JUY֓/���pkzȈ�,�𪇃j�ꀥW�״e�J�F��VBI�\r��pF�Nقֶ�*ը�3k�0�D�{����`q��ҲBq�e�D�c���V�E���n����FG�E�>j�����0g�a|�Sh�7u�݄�\$���;a��7&��R[WX���(q�#���P���ז�c8!�H���VX�Ď�j��Z������Q,DUaQ�X0��ը���Gb��l�B�t9-oZ���L���­�pˇ�x6&��My��sҐ����\"�̀�R�IWU`c���}l<|�~�w\"��vI%r+��R�\n\\����][��6�&���ȭ�a�Ӻ��j�(ړ�Tѓ��C'��� '%de,�\n�FC�эe9C�N�Ѝ�-6�Ueȵ��CX��V������+�R+�����3B��ڌJ�虜��T2�]�\0P�a�t29��(i�#�aƮ1\"S�:�����oF)k�f���Ъ\0�ӿ��,��w�J@��V򄎵�q.e}KmZ����XnZ{G-���ZQ���}��׶�6ɸ���_�؁Չ�\n�@7�` �C\0]_ ��ʵ����}�G�WW: fCYk+��b۶���2S,	ڋ�9�\0﯁+�W�Z!�e��2������k.Oc��(v̮8�DeG`ۇ�L���,�d�\"C���B-�İ(����p���p�=����!�k������}(���B�kr�_R�ܼ0�8a%ۘL	\0���b������@�\"��r,�0T�rV>����Q��\"�r��P�&3b�P��-�x���uW~�\"�*舞�N�h�%7���K�Y��^A����C����p����\0�..`c��+ϊ�GJ���H���E����l@|I#Ac��D��|+<[c2�+*WS<�r��g���}��>i�݀�!`f8�(c����Q�=f�\n�2�c�h4�+q���8\na�R�B�|�R����m��\\q��gX����ώ0�X�`n�F���O p��H�C��jd�f��EuDV��bJɦ��:��\\�!mɱ?,TIa���aT.L�]�,J��?�?��FMct!a٧R�F�G�!�A���rr�-p�X��\r��C^�7���&�R�\0��f�*�A\n�՛H��y�Y=���l�<��A�_��	+��tA�\0B�<Ay�(fy�1�c�O;p���ᦝ`�4СM��*��f�� 5fvy {?���:y��^c��u�'���8\0��ӱ?��g��� 8B��&p9�O\"z���rs�0��B�!u�3�f{�\0�:�\n@\0����p���6�v.;�����b�ƫ:J>˂��-�B�hkR`-����aw�xEj����r�8�\0\\����\\�Uhm� �(m�H3̴�S����q\0��NVh�Hy�	��5�M͎e\\g�\n�IP:Sj�ۡٶ�<���x�&�L��;nfͶc�q��\$f�&l���i�����0%yΞ�t�/��gU̳�d�\0e:��h�Z	�^�@��1��m#�N��w@��O��zG�\$�m6�6}��ҋ�X'�I�i\\Q�Y���4k-.�:yz���H��]��x�G��3��M\0��@z7���6�-DO34�ދ\0Κ��ΰt\"�\"vC\"Jf�Rʞ��ku3�M��~����5V ��j/3���@gG�}D���B�Nq��=]\$�I��Ӟ�3�x=_j�X٨�fk(C]^j�M��F��ա��ϣCz��V��=]&�\r�A<	������6�Ԯ�״�`jk7:g��4ծ��YZq�ftu�|�h�Z��6��i〰0�?��骭{-7_:��ސtѯ�ck�`Y��&���I�lP`:�� j�{h�=�f	��[by��ʀoЋB�RS���B6��^@'�4��1U�Dq}��N�(X�6j}�c�{@8���,�	�PFC���B�\$mv���P�\"��L��CS�]����E���lU��f�wh{o�(��)�\0@*a1G� (��D4-c��P8��N|R���VM���n8G`e}�!}���p�����@_���nCt�9��\0]�u��s���~�r��#Cn�p;�%�>wu���n�w��ݞ�.���[��hT�{��值	�ˁ��J���ƗiJ�6�O�=������E��ٴ��Im���V'��@�&�{��������;�op;^��6Ŷ@2�l���N��M��r�_ܰ�Í�` �( y�6�7�����ǂ��7/�p�e>|��	�=�]�oc����&�xNm���烻��o�G�N	p����x��ý���y\\3����'�I`r�G�]ľ�7�\\7�49�]�^p�{<Z��q4�u�|��Qۙ��p���i\$�@ox�_<���9pBU\"\0005�� i�ׂ��C�p�\n�i@�[��4�jЁ�6b�P�\0�&F2~������U&�}����ɘ	��Da<��zx�k���=���r3��(l_���FeF���4�1�K	\\ӎld�	�1�H\r���p!�%bG�Xf��'\0���	'6��ps_��\$?0\0�~p(�H\n�1�W:9�͢��`��:h�B��g�B�k��p�Ɓ�t��EBI@<�%����` �y�d\\Y@D�P?�|+!��W��.:�Le�v,�>q�A���:���bY�@8�d>r/)�B�4���(���`|�:t�!����?<�@���/��S��P\0��>\\�� |�3�:V�uw���x�(����4��ZjD^���L�'���C[�'�����jº[�E�� u�{KZ[s���6��S1��z%1�c��B4�B\n3M`0�;����3�.�&?��!YA�I,)��l�W['��ITj���>F���S���BбP�ca�ǌu�N����H�	LS��0��Y`���\"il�\r�B���/����%P���N�G��0J�X\n?a�!�3@M�F&ó����,�\"���lb�:KJ\r�`k_�b��A��į��1�I,�����;B,�:���Y%�J���#v��'�{������	wx:\ni����}c��eN���`!w��\0�BRU#�S�!�<`��&v�<�&�qO�+Σ�sfL9�Q�Bʇ����b��_+�*�Su>%0�����8@l�?�L1po.�C&��ɠB��qh�����z\0�`1�_9�\"���!�\$���~~-�.�*3r?�ò�d�s\0����>z\n�\0�0�1�~���J����|Sޜ��k7g�\0��KԠd��a��Pg�%�w�D��zm�����)����j�����`k���Q�^��1���+��>/wb�GwOk���_�'��-CJ��7&����E�\0L\r>�!�q́���7����o��`9O`�����+!}�P~E�N�c��Q�)��#��#�����������J��z_u{��K%�\0=��O�X�߶C�>\n���|w�?�F�����a�ϩU����b	N�Y��h����/��)�G��2���K|�y/�\0��Z�{��P�YG�;�?Z}T!�0��=mN����f�\"%4�a�\"!�ޟ����\0���}��[��ܾ��bU}�ڕm��2�����/t���%#�.�ؖ��se�B�p&}[˟��7�<a�K���8��P\0��g��?��,�\0�߈r,�>���W����/��[�q��k~�CӋ4��G��:��X��G�r\0������L%VFLUc��䑢��H�ybP��'#��	\0п���`9�9�~���_��0q�5K-�E0�b�ϭ�����t`lm����b��Ƙ; ,=��'S�.b��S���Cc����ʍAR,����X�@�'��8Z0�&�Xnc<<ȣ�3\0(�+*�3��@&\r�+�@h, ��\$O���\0Œ��t+>����b��ʰ�\r�><]#�%�;N�s�Ŏ����*��c�0-@��L� >�Y�p#�-�f0��ʱa�,>��`����P�:9��o���ov�R)e\0ڢ\\����\nr{îX����:A*��.�D��7�����#,�N�\r�E���hQK2�ݩ��z�>P@���	T<��=�:���X�GJ<�GAf�&�A^p�`���{��0`�:���);U !�e\0����c�p\r�����:(��@�%2	S�\$Y��3�hC��:O�#��L��/����k,��K�oo7�BD0{���j��j&X2��{�}�R�x��v���أ�9A����0�;0�����-�5��/�<�� �N�8E����	+�Ѕ�Pd��;���*n��&�8/jX�\r��>	PϐW>K��O��V�/��U\n<��\0�\nI�k@��㦃[��Ϧ²�#�?���%���.\0001\0��k�`1T� ����ɐl�������p���������< .�>��5��\0��	O�>k@Bn��<\"i%�>��z��������3�P�!�\r�\"��\r �>�ad���U?�ǔ3P��j3�䰑>;���>�t6�2�[��޾M\r�>��\0��P���B�Oe*R�n���y;� 8\0���o�0���i���3ʀ2@����?x�[����L�a����w\ns����A��x\r[�a�6�clc=�ʼX0�z/>+����W[�o2���)e�2�HQP�DY�zG4#YD����p)	�H�p���&�4*@�/:�	�T�	���aH5���h.�A>��`;.���Y��a	���t/ =3��BnhD?(\n�!�B�s�\0��D�&D�J��)\0�j�Q�y��hDh(�K�/!�>�h,=�����tJ�+�S��,\"M�Ŀ�N�1�[;�Т��+��#<��I�Zğ�P�)��LJ�D��P1\$����Q�>dO��v�#�/mh8881N:��Z0Z���T �B�C�q3%��@�\0��\"�XD	�3\0�!\\�8#�h�v�ib��T�!d�����V\\2��S��Œ\nA+ͽp�x�iD(�(�<*��+��E��T���B�S�CȿT���� e�A�\"�|�u�v8�T\0002�@8D^oo�����|�N������J8[��3����J�z׳WL\0�\0��Ȇ8�:y,�6&@�� �E�ʯݑh;�!f��.B�;:���[Z3������n���ȑ��A���qP4,��Xc8^��`׃��l.����S�hޔ���O+�%P#Ρ\n?��IB��eˑ�O\\]��6�#��۽؁(!c)�N����?E��B##D �Ddo��P�A�\0�:�n�Ɵ�`  ��Q��>!\r6�\0��V%cb�HF�)�m&\0B�2I�5��#]���D>��3<\n:ML��9C���0��\0���(ᏩH\n����M�\"GR\n@���`[���\ni*\0��)������u�)��Hp\0�N�	�\"��N:9q�.\r!���J��{,�'����4�B���lq���Xc��4��N1ɨ5�Wm��3\n��F��`�'��Ҋx��&>z>N�\$4?����(\n쀨>�	�ϵP�!Cq͌��p�qGLqq�G�y�H.�^��\0z�\$�AT9Fs�Ѕ�D{�a��cc_�G�z�)� �}Q��h��HBָ�<�y!L����!\\�����'�H(��-�\"�in]Ğ���\\�!�`M�H,gȎ�*�Kf�*\0�>6���6��2�hJ�7�{nq�8����H�#c�H�#�\r�:��7�8�܀Z��ZrD��߲`rG\0�l\n�I��i\0<����\0Lg�~���E��\$��P�\$�@�PƼT03�HGH�l�Q%*\"N?�%��	��\n�CrW�C\$��p�%�uR`��%��R\$�<�`�Ifx���\$/\$�����\$���O�(���\0��\0�RY�*�/	�\rܜC9��&hh�=I�'\$�RRI�'\\�a=E����u·'̙wI�'T���������K9%�d����!��������j�����&���v̟�\\=<,�E��`�Y��\\����*b0>�r��,d�pd���0DD ̖`�,T �1�% P���/�\r�b�(���J����T0�``ƾ����J�t���ʟ((d�ʪ�h+ <Ɉ+H%i�����#�`� ���'��B>t��J�Z\\�`<J�+hR���8�hR�,J]g�I��0\n%J�*�Y���JwD��&ʖD�������R�K\"�1Q�� ��AJKC,�mV�������-���KI*�r��\0�L�\"�Kb(����J:qKr�d�ʟ-)��ˆ#Ը�޸[�A�@�.[�Ҩʼ�4���.�1�J�.̮�u#J���g\0��򑧣<�&���K�+�	M?�/d��%'/��2Y��>�\$��l�\0��+����}-t��ͅ*�R�\$ߔ��K�.����JH�ʉ�2\r��B���(P���6\"��nf�\0#Ї ��%\$��[�\n�no�LJ�����e'<����1K��y�Y1��s�0�&zLf#�Ƴ/%y-�ˣ3-��K��L�΁��0����[,��̵,������0���(�.D��@��2�L+.|�����2�(�L�*��S:\0�3����G3l��aːl�@L�3z4�ǽ%̒�L�3����!0�33=L�4|ȗ��+\"���4���7�,\$�SPM�\\��?J�Y�̡��+(�a=K��4���C̤<Ё�=\$�,��UJ]5h�W�&t�I%��5�ҳ\\M38g�́5H�N?W1H��^��Ը�Y͗ؠ�͏.�N3M�4Å�`��i/P�7�dM>�d�/�LR���=K�60>�I\0[��\0��\r2���Z@�1��2��7�9�FG+�Ҝ�\r)�hQtL}8\$�BeC#��r*H�۫�-�H�/���6��\$�RC9�ب!���7�k/P�0Xr5��3D���<T�Ԓq�K���n�H�<�F�:1SL�r�%(��u)�Xr�1��nJ�I��S�\$\$�.·9��IΟ�3 �L�l���Ι9��C�N�#ԡ�\$�/��s��9�@6�t���N�9���N�:����7�Ӭ�:D���M)<#���M}+�2�N��O&��JNy*���ٸ[;���O\"m����M�<c�´���8�K�,���N�=07s�JE=T��O<����J�=D��:�C<���ˉ=���K�ʻ̳�L3�����LTЀ3�S,�.���q-��s�7�>�?�7O;ܠ`�OA9���ϻ\$���O�;��`9�n�I�A�xp��E=O�<��5����2�O�?d�����`N�iO�>��3�P	?���O�m��S�M�ˬ��=�(�d�Aȭ9���\0�#��@��9D����&���?����i9�\n�/��A���ȭA��S�Po?kuN5�~4���6���=򖌓*@(�N\0\\۔dG��p#��>�0��\$2�4z )�`�W���+\0��80�菦������z\"T��0�:\0�\ne \$��rM�=�r\n�N�P�Cmt80�� #��J=�&��3\0*��B�6�\"������#��>�	�(Q\n���8�1C\rt2�EC�\n`(�x?j8N�\0��[��QN>���'\0�x	c���\n�3��Ch�`&\0���8�\0�\n���O`/����A`#��Xc���D �tR\n>���d�B�D�L��������Dt4���j�p�GAoQoG8,-s����K#�);�E5�TQ�G�4Ao\0�>�tM�D8yRG@'P�C�	�<P�C�\"�K\0��x��~\0�ei9���v))ѵGb6���H\r48�@�M�:��F�tQ�!H��{R} �URp���O\0�I�t8������[D4F�D�#��+D�'�M����>RgI���Q�J���U�)Em���TZ�E�'��iE����qFzA��>�)T�Q3H�#TL�qIjNT���&C��h�X\nT���K\0000�5���JH�\0�FE@'љFp�hS5F�\"�oѮ�e%aoS E)� ��DU��Q�Fm�ѣM��Ѳe(tn� �U1ܣ~>�\$��ǂ��(h�ǑG�y`�\0��	��G��3�5Sp(��P�G�\$��#��	���N�\n�V\$��]ԜP�=\"RӨ?Lzt��1L\$\0��G~��,�KN�=���GM����NS�)��O]:ԊS}�81�RGe@C�\0�OP�S�N�1��T!P�@��S����S�G`\n�:��P�j�7R� @3��\n� �������DӠ��L�����	��\0�Q5���CP��SMP�v4��?h	h�T�D0��֏��>&�ITx�O�?�@U��R8@%Ԗ��K���N�K��RyE�E#�� @����%L�Q�Q����?N5\0�R\0�ԁT�F�ԔR�S�!oTE�C(�����ĵ\0�?3i�SS@U�QeM��	K�\n4P�CeS��\0�NC�P��O�!�\"RT�����S�N���U5OU>UiI�PU#UnKP��UYT�*�C��U�/\0+���)��:ReA�\$\0���x��WD�3���`����U5�IHUY��:�P	�e\0�MJi�����Q�>�@�T�C{��u��?�^�v\0WR�]U}C��1-5+U�?�\r�W<�?5�JU-SX��L�� \\t�?�sM�b�ՃV܁t�T�>�MU+�	E�c���9Nm\rRǃC�8�S�X�'R��XjCI#G|�!Q�Gh�t�Q��� )<�Y�*��RmX0����M���OQ�Y�h���du���Z(�Ao#�NlyN�V�Z9I���M��V�ZuOՅT�T�EՇַS�e����\n�X��S�QER����[MF�V�O=/����>�gչT�V�oU�T�Z�N�*T\\*����S-p�S��V�q��M(�Q=\\�-UUUV�C���Z�\nu�V\$?M@U�WJ\r\rU��\\�'U�W]�W��W8�N�'#h=oC���F(��:9�Yu����V-U�9�]�C�:U�\\�\n�qW���(TT?5P�\$ R3�⺟C}`>\0�E]�#R��	��#R�)�W���:`#�G�)4�R��;��ViD%8�)Ǔ^�Q��#�h	�HX	��\$N�x��#i x�ԒXR��'�9`m\\���\nE��Q�`�bu@��N�dT�#YY����GV�]j5#?L�xt/#���#酽O�P��Q��6����^� �������M\\R5t�Ӛp�*��X�V\"W�D�	oRALm\rdG�N	����6�p\$�P废E5����Tx\n�+��C[��V�����8U�Du}ػF\$.��Q-;4Ȁ�NX\n�.X�b͐�\0�b�)�#�N�G4K��ZS�^״M�8��d�\"C��>��dHe\n�Y8���.� ���ҏF�D��W1cZ6��Q�KH�@*\0�^���\\Q�F�4U3Y|�=�Ӥ�E��ۤ�?-�47Y�Pm�hYw_\r�VeױM���ُe(0��F�\r�!�PUI�u�7Q�C�ю?0����gu\rqधY-Q�����=g\0�\0M#�U�S5Zt�֟ae^�\$>�ArV�_\r;t���HW�Z�@H��hzD��\0�S2J� HI�O�'ǁe�g�6�[�R�<�?� /��KM����\n>��H�Z!i����TX6���i�C !ӛg�� �G }Q6��4>�w�!ڙC}�VB�>�UQڑj�8c�U�T���'<�>����HC]�V��7jj3v���`0���23����x�@U�k�\n�:Si5��#Y�-w����M?c��MQ�GQ�уb`��\0�@��ҧ\0M��)ZrKX�֟�Wl������l�TM�D\r4�QsS�40�sQ́�mY�h�d��C`{�V�gE�\n��XkՁ�'��,4���^�6�#<4��NXnM):��OM_6d�������[\"KU�n��?l�x\0&\0�R56�T~>��ո?�Jn��� ��Z/i�6���glͦ�U��F}�.����JL�CTbM�4��cL�TjSD�}Jt���Z����:�L���d:�Ez�ʤ�>��V\$2>����[�p�6��R�9u�W.?�1��RHu���R�?58Ԯ��D��u���p�c�Z�?�r׻ Eaf��}5wY���ϒ���W�wT[Sp7'�_aEk�\"[/i��#�\$;m�fأWO����F�\r%\$�ju-t#<�!�\n:�KEA����]�\nU�Q�KE��#��X��5[�>�`/��D��֭VEp�)��I%�q���n�x):��le���[e�\\�eV[j�����7 -+��G�WEwt�WkE�~u�Q/m�#ԐW�`�yu�ǣD�A�'ױ\r��ՙO�D )ZM^��u-|v8]�g��h���L��W\0���6�X��=Y�d�Q�7ϓ��9����r <�֏�D��B`c�9���`�D�=wx�I%�,ᄬ�����j[њ����O��� ``��|�����������.�	AO���	��@�@ 0h2�\\�ЀM{e�9^>���@7\0��˂W���\$,��Ś�@؀����w^fm�,\0�yD,ם^X�.�ֆ�7����2��f;��6�\n����^�zC�קmz��n�^���&LFF�,��[��e��aXy9h�!:z�9c�Q9b� !���Gw_W�g�9���S+t���p�tɃ\nm+����_�	��\\���k5���]�4�_h�9 ��N����]%|��7�֜�];��|���X��9�|����G���[��\0�}U���MC�I:�qO�Vԃa\0\r�R�6π�\0�@H��P+r�S�W���p7�I~�p/��H�^������E�-%��̻�&.��+�Jђ;:���!���N�	�~����/�W��!�B�L+�\$��q�=��+�`/Ƅe�\\���x�pE�lpS�JS�ݢ��6��_�(ů���b\\O��&�\\�59�\0�9n���D�{�\$���K��v2	d]�v�C�����?�tf|W�:���p&��Ln��賞�{;���G�R9��T.y���I8���\rl� �	T��n�3���T.�9��3����Z�s����G����:	0���z��.�]��ģQ�?�gT�%��x�Ռ.����n<�-�8B˳,B��rgQ�����Ɏ`��2�:{�g��s��g�Z��� ׌<��w{���bU9�	`5`4�\0BxMp�8qnah�@ؼ�-�(�>S|0�����3�8h\0���C�zLQ�@�\n?��`A��>2��,���N�&��x�l8sah1�|�B�ɇD�xB�#V��V�׊`W�a'@���	X_?\n�  �_�. �P�r2�bUar�I�~��S���\0ׅ\"�2����>b;�vPh{[�7a`�\0�˲j�o�~���v��|fv�4[�\$��{�P\rv�BKGbp������O�5ݠ2\0j�لL���)�m��V�ejBB.'R{C��V'`؂ ��%�ǀ�\$�O��\0�`����4 �N�>;4���/�π��*��\\5���!��`X*�%��N�3S�AM���Ɣ,�1����\\��caϧ ��@��˃�B/����0`�v2��`hD�JO\$�@p!9�!�\n1�7pB,>8F4��f�π:��7���3��3����T8�=+~�n���\\�e�<br����Fز� ��C�N�:c�:�l�<\r��\\3�>���6�ONn��!;��@�tw�^F�L�;���,^a��\ra\"��ڮ'�:�v�Je4�א;��_d\r4\r�:����S�����2��[c��X�ʦPl�\$�ޣ�i�w�d#�B��b��������`:���~ <\0�2����R���P�\r�J8D�t@�E��\0\r͜6����7����Y���\"����\r�����3��.�+�z3�;_ʟvL����wJ�94�I�Ja,A����;�s?�N\nR��!��ݐ�Om�s�_��-zۭw���zܭ7���z���M����o����\0��a��ݹ4�8�Pf�Y�?��i��eB�S�1\0�jDTeK��UYS�?66R	�c�6Ry[c���5�]B͔�R�_eA)&�[凕XYRW�6VYaeU�fYe�w��U�b�w�E�ʆ;z�^W�9��ק�ݖ��\0<ޘ�e�9S���da�	�_-��L�8ǅ�Q��TH[!<p\0��Py5�|�#��P�	�9v��2�|Ǹ��fao��,j8�\$A@k����a���b�c��f4!4���cr,;�����b�=��;\0��ź���cd��X�b�x�a�Rx0A�h�+w�xN[��B��p���w�T�8T%��M�l2�������}��s.kY��0\$/�fU�=��s�gK���M� �?���`4c.��!�&�分g��f�/�f1�=��V AE<#̹�f\n�)���Np��`.\"\"�A�����q��X��٬:a�8��f��Vs�G��r�:�V��c�g�Vl��g=��`��W���y�gU��˙�Ẽ�eT=�����x 0� M�@����%κb���w��f��O�筘�*0���|t�%��P��p��gK���?p�@J�<Bٟ#�`1��9�2�g�!3~����nl��f��Vh���.����aC���?���-�1�68>A��a�\r��y�0��i�J�}�������z:\r�)�S���@��h@���Y���mCEg�cyφ��<���h@�@�zh<W��`��:zO���\r��W���V08�f7�(Gy���`St#��f�#����C(9���؀d���8T:���0�� q���79��phAg�6�.��7Fr�b� �j��A5��a1��h�ZCh:�%��gU��D9��Ɉ�׹��0~vTi;�VvS��w��\r΃?��f�����n�ϛiY��a��3�·9�,\n��r��,/,@.:�Y>&��F�)�����}�b���iO�i��:d�A�n��c=�L9O�h{�� 8hY.������������\r��և�����1Q�U	�C�h��e�O���+2o����N�����zp�(�]�h��Z|�O�c�zD���;�T\0j�\0�8#�>Ύ�=bZ8Fj���;�޺T酡w��)���N`���ÅB{��z\r�c���|dTG�i�/��!i��0���'`Z:�CH�(8�`V������\0�ꧩ��W��Ǫ��zgG������-[��	i��N\rq��n���o	ƥfEJ��apb��}6���=o���,t�Y+��EC\r�Px4=����@���.��F��[�zq���X6:FG��#��\$@&�ab��hE:����`�S�1�1g1���2uhY��_:Bߡdc�*���\0�ƗFYF�:���n���=ۨH*Z�Mhk�/�냡�zٹ]��h@����1\0��ZK�������^+�,vf�s��>���O�|���s�\0֜5�X��ѯF��n�A�r]|�Ii4�� ��C� h@ع����cߥ�6smO������gX�V2�6g?~��Y�Ѱ�s�cl \\R�\0��c��A+�1������\n(����^368cz:=z��(�� ;裨�s�F�@`;�,>yT��&��d�Lן��%��-�CHL8\r��b�����Mj]4�Ym9����Z�B��P}<���X���̥�+g�^�M� + B_Fd�X���l�w�~�\r⽋�\":��qA1X������3�ΓE�h�4�ZZ��&����1~!N�f��o���\nMe�଄��XI΄�G@V*X��;�Y5{V�\n���T�z\rF�3}m��p1�[�>�t�e�w����@V�z#��2��	i���{�9��p̝�gh���+[elU���A�ٶӼi1�!��omm�*K���}��!�Ƴ��{me�f`��m��C�z=�n�:}g� T�mLu1F��}=8�Z���O��mFFMf��OO����������/����ޓ���V�oqj���n!+����Z��I�.�9!nG�\\��3a�~�O+��::�K@�\n�@���Hph��\\B��dm�fvC���P�\" ��.nW&��n��HY�+\r���z�i>Mfqۤ��Qc�[�H+��o��*�1'��#āEw�D_X�)>�s��-~\rT=�������- �y�m����{�h��j�M�)�^����'@V�+i�������;F��D[�b!����B	��:MP���ۭoC�vAE?�C�IiY��#�p�P\$k�J�q�.�07���x�l�sC|���bo�2�X�>M�\rl&��:2�~��cQ����o��d�-��U�Ro�Y�nM;�n�#��\0�P�f��Po׿(C�v<���[�o۸����fѿ���;�ẖ�[�Y�.o�Up���pU���.���B!'\0���<T�:1�������<���n��F���I�ǔ��V0�ǁRO8�w��,aF��ɥ�[�Ο��YO����/\0��ox���Q�?��:ً���`h@:�����/M�m�x:۰c1������v�;���^���@��@�����\n{�����;���B��8�� g坒�\\*g�yC)��E�^�O�h	���A�u>���@�D��Y�����`o�<>��p���ķ�q,Y1Q��߸��/qg�\0+\0���D���?�� ����k:�\$����ץ6~I��=@���!��v�zO񁚲�+���9�i����a������g������?��0Gn�q�]{Ҹ,F���O���� <_>f+��,��	���&�����·�y�ǩO�:�U¯�L�\n�úI:2��-;_Ģ�|%�崿!��f�\$���Xr\"Kni����\$8#�g�t-��r@L�圏�@S�<�rN\n�D/rLdQk࣓�����e����Э��\n=4)�B���ך��Z-|Hb����Hk�*	�Q!�'��G ��Ybt!��(n,�P�Ofq�+X�Y����\"b F6��r f�\"�ܳ!N��^��r�B_(�\"�K�_-<��*Q���/,)�H\0����r�\"z2(�tه.F>��#3���268sh٠��ƑI1Sn20���-��4���2A�s(�4�˶��\0��#��r�K'�ͷG'�7&\n>x���J�GO8,�0���8���\0�W9��I�?:3n�\r-w:�����;3ȉ�!�;��ꃘ�Z�RM�+>�����0/=R�'1�4�8����m�%ȥ}χ9�;�=�nQ��=�hhL��G�kW�\r�	%�4Ҝs�ΖJ�3s�4�@�U�%\$���N;�?4���N��2|��Z�3�h\0�3�5�^�xi2d\r|�M�ʣbh|�#v�` \0�ꐮ���\$\r2h#���?���I\n���+o-��?6`ṽ�.\$���KY%�J?�c�R�N#K:�K�EL�>:��@��jP��n_t&slm�'�ЩɸӜ�����;6ۗHU5#�Q7U��WY�U bN��W�_���;TC�[�<ږ>����W�CU��6X#`MI:t�ӵ��	u#`�fu�\$�t���X�`�f<�;b�gh���9�7�S58���#^�-�\0����չR*�'��(���qZ壣�X�Q�FUv�W GW���T��W�~ڭ^�W�����J=_ؗbm��bV\\l��/�M��TmTOXu�=_��ITvvu�a\rL_�qR/]]m�su=H=u�g o\\UՅgM�	XVU��%�h��53U�\\=��Q��M�v���g�m��ue�����h�b�M�GCeO5�ԁ�O5��Y�i=e�	G�TURvOa�*�ivWX�J5<��bu�]������<����\$u3v#�'e�u�R5m��v�D5�.v���W=�U_�(�\\V��_<��S�n)�1M%Qh�Z�T�f5E�'��W��v�UmiՂU��]aW�U�dRv��-YUZu��UV��UiR�V������[��ZMU�\\=�v{�X���wQ�huHv��gqݴw!�oqt�U{TGq�{�#^G_ubQ���i9Qb>�NUd��k��5hP�mu[�\0����_��[�Y-����r���(�CrMe�J�!h?QrX3 x���#��x�<�{u5~���-�u��YyQ\r-��\0�uգuuٿpUڅ�)�P��\r<u�S�0��w��-i���!�֊�B���d]��Ň��E��vlmQݏ6k��J��w�Ğ����ED�U�R�e�v:X�c�NW}`-�t�H#e��b��u���	~B7� ?�	OP�CW���SE͕V>���U�7�����m�ӂ�z�=����1���+��m�I,>�X7��]�.��*	^��N��.��/\"���)�	���s��|��ӟ�l�}�����!�5n�p�j��h�}���m�E�zH�aO0d=A|w�߳������u���v���G�x#��b�cS�o-��tOm`C��^M��@�h�n\$k�`�`HD^�PE�[�]��rR�m�=�.�ه>Ayi� \"���	��o�-,.�\nq+���fXd����*߽�K�؃'�� �%a����9p���KLM��!�,������zX#�V�uH%!��63�J�ryՁ��q_�u	�W����|@3b1��7|~wﱳ��A7���	��9cS&{���%Vx��kZO��w�Ur?����N �|�C�#Ű��կ �/��9�ft�Ew�C��a�^\0�O<�W�{Y�=�e��n���gyf0h@�S�\0:C���^��VgpE9:85�3�ާ���@��j_�[�+��ǩx�^�ꮆ~@чW���㓜�9x�FC���.�����k^I���pU9��S������\$���\r4���\0��O���)L[�p?�.PECS�I1nm{�?�P�WA߲�;���D�;S�a�Kf��%�?�X��+��B>��9���Gj�c�z�A͎�:�a�n0bJ{o��!3��!'��K�����}�\\��3W��5�x���L;�2ζn�a;���׺Xӛ]�o��x�{�5ޙjX���vӚ��q��EE{р4����{���	�\n��>��aﯷ�����L����������'����{�\n��>J�ߌ��ӗ��Y�\rOʽ�t����-O���4��9F�;�����G��I�F��1�o����O���a{w�0����Ư;񔄑l�o��J�Tb\rw�2�J��=D#�n�:�y��S�^�,.�?(�I\$���Ư��3��s�4M�aCR���G̑��I߰n<�zy�XN��?��.��=���DǼ�\r����\n��\ro��\nПCl%��Y���߰��G���}#�VН%�(����3�ɍ�r��};��׿G��n�[�{����_<m4[	I����q��?�0cV�nms��nM���\"Nj1�w?@�\$1��>��^�����\\�{n�\\���7���ٟic1���hoo�?j<G�x�l���S�r}���|\"}��/�?s��tI���&^�1e��t��,�*'F��=�/F�k�,95rV������쑈��o9��/F��_�~*^��{�I����_�����^n���N��~���A�d����U�w�qY���T�2��G�?�&����:y��%��X�J�C�d	W�ߎ~�G!��J}��������B-��;���h�*�R���E��~���.�~���SAqDVx���='��E�(^���~����������o7~�M[��Q��(��y��nP�>[WX{q�aϤ���.&N�3]��HY������[���&�8?�3������݆����#���B�e�6��@��[������G\r�+��}������_��7�|N����4~(z�~����%��?����[��1�S�]x�k��KxO^�A���rZ+����*�W��k�wD(���R:��\0����'����m!O�\n��u���.�[ �P�!��}��m ��1p�u��,T��L 	0}��&P٥\n�=D�=���\rA/�o@��2�t�6�DK��\0���q�7�l���B���(�;[��kr\r�;#���lŔ\r�<}zb+��O�[�WrX�`�Z ţ�Pm'Fn����Sp�-�\0005�`d���P���Ǿ��;��n\0�5f�P���EJ�w�� �.?�;��N�ޥ,;Ʀ�-[7��e��i��-���dَ<[~�6k:&�.7�]�\0������/�59 ��@eT:煘�3�d�sݝ�5䏜5f\0�P��HB�����8J�LS\0vI\0���7Dm��a�3e��?B��\$�.E���f���@�n���b�Gb��q3�|��Paˈ�ϯX7Tg>�.�p�5��AHŵ��3S�,��@�#&w��3��m[���I�ѥ�^�̤J1?�gTၽ#�S�=_��_��	���Vq/C۾�݀�|�����D �g>܄��� 6\r�7}q��Ť�JG�B^�\\g������&%��[�2Ixì��6\03]�3�{�@RU��M��v<�1����sz�uP�5��F:�i�|�`�q���V| ��\nk��}�'|�gd�!�8� <,�P7�m��||���I�A��]BB �F�0X���	�D��`W���qm�OL�	�.�(�p��ҁ��\"!����\0��A����V��7k��M�\$�N0\\���\"�f������\0uq��,��5��A6�p���\n�ΐjY�7[pK��4;�l�5n��@�\\f��l	��M���P��3��C�HbЌ��cEpP���4eooe�{\r-��2.�֥��P50u���G}��\0����<\r��!��~�������\n7F��d�����>��a��%�c6Ԟ��M��|��d����O�_�?J��C0�>Ё�&7kM4�`%f�l�ΘB~�wx��ZG�P�2��0�=�*p��@�BeȔ��|2�\r�?q��8����Њ(�yr���0��>�>�E?w�|r]�%Av�����@�+�X��Ag����s��C��AXmNҝ�4\0\r���8J�J�ǸD�Қ�:=	������S�4��F;	�\\&��P!6%\$i�xi4c�0B�;62=��1��̈PC��m���dpc+�5��\$/rCR�`�MQ�6(\\��2A���\\��lG�l�\0Bq��P�r���B����т�_6Ll�!BQ��IG�����XRbs�]B�Hr���`�X��\$p�8���	nbR,±�L��\"�E%\0�aYB�s���D,�!��ϛpN9RbG�4��M��t����jU�����y\0��%\$.�iL!x��ғ�(�.�)6T(�I��a%�K�]m�t���&��G7�ITM�B�\rza��])va�%���41T�j͹(!�����\\�\\�W��\\t\$�0��%�\0aK\$�T�F(Y�C@��H���H�nD�d��Wp��hZ�'�ZC,/���\$����J�FB�uܬQ:Υ�A��:-a#��=jb��l�Ug;{R��U��EWn�Ua��V��Nj��u�G�*�yֹ%��@��*���Yx�_�z�]�)v\"��R��L�VIv�=`��'��U�) S\r~R���\ni��)5S��D49~�b�;)3�,�9M3�HsJkT�Ü�(����uJ�][\$uf��ob���\n.,�Yܵ9j1'��!�1�\$J��gڤ՟ĆU0��Zuah���cH��,�Yt��Kb�5��5��/dY��AU�҅��[W>�_V�\r��*���j��-T�� z�Y�d�c�m�ҹ��:����[Ut-{���l	�i+a)�.[��_:�5��h��W§�m��%JI��[T�h>�������;�X̺d�S�d�V�;\rƱ!N��K&�A�Ju4B��dg΢.Vp��mb��)�V!U\0G丨��`���\\��q�7Q�b�VL��:�Ղ���Z.�N��*�ԏU]Z�l�z������R D1I��£�r:\0<1~;#�Jb���M�y�+�۔/�\"ϛj<3�#��̌��:P.}�e����D\"q�yJ�G���sop�����X�\r��d��\rxJ%���ƼO:%yy��,��%{�3<�Xø����z�E�z(\0 �D_���.2+�g�b�c�x�pgި��|9CP����48U	Q�/Aq��Q�(4 7e\$D��v:�V�b��N4[��iv���2�\r�X1��AJ(<PlF�\0���\\z�)���W�(�4����� p�����`��\r�da6����O��m�a�}q�`��6P�'h��3�|����f� j��A�z���+�D�UW�D���5��%#�x�3{��L\r-͙]:jd�P	j�f�q:Z�\"sad�)�G�3	��+��r�NK��1Q���x=>�\"��-�:�F���Iك*�@ԟ�y�T�\\U��Y~������3D������f,s�8HV�'�t9v(:��B9�\\Z����(�&�E8���W\$X\0�\n��9�WB��b��66j9� �ʈ��?,��| �a��g1�\nPs�\0@�%#K����\r\0ŧ\0���0�?�š,�\0��h��h�\08\0l\0�-�Z��jb�Ŭ\0p\0�-�f`ql��0\0i-�\\ps��7�e\"-Z�lb�E�,�\0��]P ��E��b\0�/,Z��\r�\0000�[f-@\rӯEڋ�/�Z8��~\"��ڋ��.^��Qw��ϋ�\0�/t_ȼ���E���\0�0d]��b�Ť�|\0��\\ؼ���E�\0af0tZ��n�J�\0l\0�0L^��Qj@��J��^��q#F(�1�/�[�1�����I�.�^8��\0[�q��[Ñl\"�� ��\0�0,d����\r����c��{cE�\0o�0�]�\0\rc%�ۋ���8�w���Z��-�\\��{��֋G�/\\bp��@1�\0a�1�����s�!Ũ�/�/�]8��~c\"�ۋ��2�cΑm�\"�9�q�/\\^fQ~c�_���-\$i�\"�\0003����fX�qx#\09��Z.�i���@F���3tZH� \rcK�b\0j�/Dj��1����I�h�a��v�Ʃ�OZ4�Z��т#YE�\0i�.hH��sX/F<���.�j���b���\0mV/d\\���b�E����3T^(�шcKFR�����]X�q��������6�]h��c6Eċ�66�h����n\0005�sn/dn��`\r\"�F���-D`�Ց��N�2�Y��bx��#\\�닇V3x�1x�Fx��\0�6�b�q����!��8|^���ub�����-�r��q��:��%�0�pp�#����\0�6�f��Ǣ�Ŭ�d�0�qH����\$�@�q�-�^B4��\"�\08�1�/lnxϑ���G�3:0tjh�~@Ƽ���3�vH��b�G(�e��4gغq��2�1��-�nX��\"�F<�Q�1\\j��1���Eǋ��4m����[�n�z7�yh�1�#�ގ/�3\\x�q�KG����6�o��1{��FJ���6�lX�q⣄�u���9�r(�1��Gc\0�f:�rX��#�Ž\0i�<\\}���b�F�\0s�7�y2���#uFe��\">4i��������\n<{�㑍��Ɖ�J;�]��1�#��0��J;4^��D���Ǯ����4i��(H#��E�x�/�n��1��/ǡ��j6,l��1t�/\0005%�0�]x����GG5�!�0��������r�q�2��ޑ��NFP�o\"4�_��1�d�%�e �3�s8���G5�� �6�[H��c�H�jY�;�[辑�b�! �y�@�\\��q�#WHN���;�c�Q��:�-�%�.�kXƑ���G͌��1Df�ߑ�cWFl��!�0����c Eܐ��;l��q�\"�F����7\\\\������O�q�.T|\"?����E��f9TyYѩ�SG1���A\$f9R\n\"��x��>B��H��ߤ\0���:\$e�1���F?�=�3Tu)\nq�b��~���<T��α�c�H.�m~C�wHʱ�#/�I�]~3�^��ф#��>�Y�4�^��Qjc��K�1\"�8�|6��c\"�B��\"b4���%����G\0e\"�/t���1r�1��e!v2�y����<Ǡ���8\\o��ђ#t�ѐ\rz@�}H�b���y �1�\\���deG��Z3�~�r)�1ȿ���Bl~H��:�dF��-�?�k8�q�c(F͋�K�5|my�c1�<�*@�j���1��ž��>I�Z��Qj��2��\$0��h�Q��VFT�	\$�Al~�qڣȱ�\$�>\\p�\rq�\$/�u%�!�Jq \$��tE��GN-Tq)�\"��Hʌ��=�X�2-�H���8\\n��RW\$H��\"�C\\_�\0�d\$�f��\".D�u	'Q�zE��&0to��qj��ƿ��R@d������u�##�LLk�*q�\$*Gđi�@T�i�l��E����5���r\\d�I���\"/�Z�0�j\$T���z5Ld3�����o�.Tq�!1{�����9�Z��Q�b�F�wJ94n�����{�(�-�8�2h�u��;\$�-Dk��rs��H���#���Y7�\"�/E����	\$j�^�-�]�7�[\"N\$����W����/]�\$�+�1Ga�/&IDn�@\$��!��\$�-�k!�Q����)(N/\$t������O�KzP�tX��[\0�G��w(*K\$v��1�c�'��G̞I�xd��\n�A�8\\rX��a��I�iN�I%\$���_���6�f�Q�#��I�5#�F��غ��#�E⒕\"�3\$�I�c�H���vR|�Q��cE���:R�e��h�EΏfK`8�r.#�E��s�0L���R��F���!\nC\$`���\$�H?��nP�e�!�@F'���/�����������%�N,h��rF\$�����3�t��Ҁ���!1<��CQ�%�Ò��J�Z�f.�6ō����C���Ԝ.�[��Bҿx����\0NRn`���Y\n�%+N�IMs:ùYd�ef�B[���nƹY��m��R�ג��Y��C�X���j��U+Vk,�\0P��b@e���x��V��yT�7�u�[J�ȱ\nD��eR��mx&�l�\0)�}�J�,\0�I�ZƵ\$k!���Yb�����Re/Q���k�5.�e��5����W�`��\0)�Yv\"V�\0��\n�%��`Yn�աa��xÆQ!,�`\"�	_.�偩Ɩtm\$�\"��J��֍���v�%�M9j��	斧�*�Kp֔�;\\R ��3(���^��:}���|>µa-'U%w*�#>�@�̬e�J���;Pw/+��5E\rjn���d���^[���cΰ�u�z\\ؐ1mi\"x��p��;����P)����#��ؒ���!A�;��	4�a{`aV{K�U��8㨟0''o�2���yc̸9]K�@�җ^�lB��Or���,du��8�?����%�gB����Yn+�%c�e\0���ऱYr@f�(]ּ�\nbiz��n�SS2��GdBPj���@�(�ȥ�!�-�v��e�*c\0��4J�炒���,�U�	d��e�j'T�H]Ԋ�G!�)u��֯��ү�Z�B5�̓W��0\n���R���W��\\�Q j�^r�%l��3,�Yy��f3&��܎�Q:ϵ2�m�R)�T��(KR��0�ʔ@��Y��Y:��e3\r%���T�%�X����ST�.J\\�0�h�ą�D!�:�u���U\"�Ł�o+7�\"����f'��R\0���J��2S�2�#nm ��I劜�\"X���[�ր��} J��c�9p0���Q�(U\0�xDEW��.L��=<B�0+�)ZS V;�\\�I{�5I�A���,dW�u�5Ew\n\$%ҁ���2i_\$��+��O,����X��ՑJg&J��G��%\\J��b.��^L�T�Fl�薹]k#f@L�G�ĐT�ٗ��H��\"�q1S̰��j�V�(Ι��ZVz�ņ�,����G�.1F��gN�;�1ÊV��5E��5`�\0Ct�=F\nṛα�K����\0�ۊ�%��D]Q\$\r\0�3J\\,͙��<T4*���.�YK�D�Q��L�S%,�g������<��u0���Uĉ�*x(��NYv!��y�	w�4fd��rG��M \$��^;�����)<P�]D�%%�;�j��I0�a�u^Jp�[)�v�3RhR�E��\n�L_�#5|ܾ�m3P�*�\\Y51X��	i�N���\$\"��a���h*KU���V8��u�%&�r�˚��5o���g�;�rMl[ƨ�g������U�q�깚h|�eO2�f MlW2AP�׹�����v~eD�e�3Uӫl�E62i�����Ub���U���������V��iI!\$i�ʭ&Z:��xm!ņ�.�O�fwү!���kݤ̓��6b\"�I�J]]:T��6�Vr��}��ǫ]����U��	ys7f�Mř�3����Y��:T_M�w%3�n��\n��z*��3�h��	�`U��L���,�ۄ�5��vf��Û�42_Q��h���uD�\no��)�ĜիM9�7foۼ��r����WB~iT�eyQT�N\n�d�pr�#��M�;���4�p���t���(;���5	|��ǂ��',AV7ܔ��UA�&��R�P�\"��y�ҷ��)�[�n���-3V��,?�s6�p���3�f��A��9k|�ɮS�f�*@��5�g��ɿ2��}����U�ݙ����H�F�l%�p«Ie�be�M�SO\r�[��i�3�f��LV��r�u�����NA�:�%r��y3Q�_̸�W.���^Sl@&���5�Yl��1���}Vx�gʅ�^Sn���Q!:5�Z�iZCԈ:���3qg�%D��ݪ{U�3�tZ�`��u%w:�ZQ:Q���W f�훿9Jpl�)�3x�v���K7�b#�����X+J�(��h��P*Ӂ���Λ��!ה�ŏSL�h*'���\npB��ڪ�gNʝ�8BuҪ���Ό��8ni�I�s�US�I��;vvڳU�sR�7N�u�8�H|���ӷ�̎��8�q����+'���`�x�9R�	ծ��MaR8�x�)��'!���;�U��Y֓��sNI�g:�KT�y�3�g��Y����k���ܳn'LO(��3�w4�4������l���J����w��9�\\����hf(�_~���}9N���\0���b\"�Y餃Th,ڞ�@��D���\$�I��;�e��U��n����,�O��	X��g�-���+>ti'G����l�%\0�8�VB�U1�ye�\0KT�4���m��V2)\r]I/\rF���X���ߨ�a��G�¹�*�����>ER������Z�-)I\$����:�a�\0�Fyba�g�w��(�_@�v}�i�ʳ�S^�25DԳ�	��URO��JH��\\�is�f��K�N��qi�Sg�O\n�F~|���*@gR�_Q<9sܬ3i+ؗ�.Cw���|���y�6a�O�Y9���ɖ\n�Խ-([���_�}�S�]c�S=��������Y��U->�<���\n<�sO�Q4F�^}\0007u�k(/���/5{L�9�\0����&��[<���s�\0&��#�@h��3�V}��H���*�w+]'D�&�@�ց])��;TGe3��\\��n����d\$:�uN4�ykt�-dR!7����e4(P!��-��9�4�_PMGb��ıw����6O�S�F���)��yh0+����qT|��+u���+��A�?��	�T�3.q��41T��e��\n:P����{T�\n��h?��T�A�S��*���+�u�>�\\�Z����Y췢wEJ��%��s�L��d��y�+\rC�ߡ'A�l,�y�3���͗`�	_*�P� ThKDV���~5	�0�+�,�-?�]���3�֍K�`�^���I42(]�w�.�r����]�\nYƨB����	��}ЋR ��g�}:H��J�WP��\"޵���V\\�<��? >�����ܬ݆�=��:�\n0��\\+�S���f�U���U,�WCֈ�On��΅��.�e9|R�I'�[�/������2���Q��Bn:�I�\n��g�9�\r�,�R6����Q\$X�+�>����`\n�)/_8Qi�����=��v?5v�\0 \n���LG�Dm�w\\�F֌�Ѣ���dꟵ}s�\"��Yv�|�J*�9h���@XEU�*�(oQ]\$�B��,�����KT�v�AptCɃ\n�C,/�<��ڙEW�-V�P��=W�*%K�-Q`9	(��59Ӏ�m)�X��@�2���T@��\nS���bd�Eδa�+�DX��|U�	�	��F� 2�%5\nj�m��W�+�x�K��V�3#��CT�ek���&�,�l�jbd7)ӓ\"\n+�P��b��I�@�3��ܵjU��Es��)D�f뒃������P�Z3AΌ�\nwTh𗲪ۘ�4Z��<�uߩ�dq�ˊu(���bKG����n�Tﮈ]z��f%#�3I�fS��&}�@D�@++��A�h���\n��U�ޥ|B�;��Um��U�E�N�!�x2�1�\0�GmvH~��H�T�)�W��YN�\"�k5��vT#=�ڥ�<\n}�#R3Y�H�R�Iͳܦ;��Rl�1l�uB%TQJ�*���'�E�0i�dw,�z�ͥ:\$��;�?���j��)��)ԏ�\$32J}�&�[�\$��́�;Dn��E״�+0�aZ{���C ���(��:����O@h��D��\0��`PTou����F�\rQv����o�ܡ\$S��+��#7��Izr�pk�DW��Fs�9��Q� ���1�g��#�\0\\L�\$��3�g�X�y�y �-3h����!�nX��]+��	ɝ�c\0�\0�b��\0\r���-{�\0�Q(�Q�\$s�0���m(�[Ru�V����>��+�J[�6����J\0֗�\\���,��K�3�.�]a_\0R�J Ɨ`�^ԶClR�IK��\n�\$�nŏ���Kj��\n����~/��mn�].�`��ij��#K��f:`\0�錀6�7K▨zc��\0����/K���/�d���FE\0aL���dZ`�J�S��ʙ�2��4�@/�(��L��0�`�ĩ��_�L��]4Zh�Щ�SD�M��4:c��SR��M�E4�i��SG�EMj��4zd�թ�SFKL��%4�e��%\$�lKM2��1�ڔ�i����MV��.�ڔ�i����Lz�/���ۣӄ��M�,`�_��imS��gMƜ�jg�����5�9.��9j_��S���.��9�_���S���.�7�r�)��%�[2�m8�uT��S��3M:�]3�q���nӱ�KN�1|^�kt�\"��H�gKj�-;zc�i�Ӛ����\r<�_�-i�Ӹ��\"֞U.���i�RڑkOF��=:\\��\$Zө�MLE�5�x����ӻ_\"֜=<\0�t��S�9OҞ�1�~��i�����O��>�~q�)�F����=6:~���J���P:��=��T�)�ƫ��PJ8�@�w�����*��O�5]>��t���T\n��!\"��6Y	)��H�/P���3�	���/��P~���	�Ӯ�!\"��C����j� �eNJ������*%�4�1Q��CZ�Q�jTB�Q.�\rE)\0004��\$�2�SM+�<j�t�j0�,�9Q��}F\0\$�s��Ta��KΣ]Ecj*�'K�M��MGx��R�T1�#QꡥG��5�:�z�L��4u6z��\"j\"T�KuN֣�G�g\$jFSܨ�Q2��H��\"�MT��%R��Hz��\$�,�w�Re.\$r�z�)��Ԧ�-Q���J���ʪ@԰�=R&/�Iʕ1�*]T���7���Q��D&өqN�_(�q�c[Tw�QR�崜J�\0n��T���.��956c�܌�Sz�H���7�R�}�Sr8�N���\"b�T��Q�5MN���#����ES§-H��7\"�T��_S�}G�̕?*yԩ��S�P*�5#���܍�T:�]Pʟ�C*�ԉ�T:�-K8�5C����R�--MȾ�H��� �'T���H���H���ы�T���R���,���܋GTک-SJ��M*�ԩ�UTکmMH��M���>�gSD�5M�R���H�wU\"��K8��R���ڌ�U*�-U*��n¾T�IR�,t�Z���Y�IUF�51���W)v�k�_KƫpJ�5Zj�ů�R�4r\n�^jI�CK����}Uʓ_��ԛ��O�=N�R*�F-��R��%W���c��\\�aV>�EYj��d���ëUά�WX�5*�Ջ��Uy��Z��1k�ը�7V��R\\H�5h*�U���UƧM[���k�vո�3V�}[(�5W�zո�iB�O��1��T���V�;�[��pR�Gu�;T@0>\0��/I���W`�]��\0���8��P��]��1m*��ǍyUz�mW��|�ݓ[��֯�]J�ш��U������Z*�5\\j����Z��`Z�5~��E�W��4Z��5h�Q�^�cXZ��S��1o�V��U&��T��5}cU^��X��dm*���kUu��SfG=[��j�sտ��X�Kc\n�iR�H�i#��uWt��������X�cĹ��U���rڢ�UZ�Շ�NE���X���4��ud�E�eV^��K��n��V8�sX¥�f��/�hJ�-J]ӂ������zO��<Eh�\$勓���\0K��<bw��>���N�\")]b�	�+z�.cS.�iF�	���QNQ���V*������O[X�nx��P	k��oN��}<aO�Iߓ�h���T;�r񉉤�VD6Q�;z�]j�~'�:�[Iv��7^ʑ����j�w[������ņ�:u �Ds#���\\w�<n|*�h�m�Kv;Y҈��3�]��^#�Z�j�gy�jħY,�%;3������.�W\"��\$�3>gڜ���Ϧ�V�T�Zj�hY�j�kD*!�h&Xz�i���+GV��\"��Z�:Ҥ�+�NoG�Zjj�i�]ʞkO�_�֬ԐmjI����t��#�[�j\rn�����n��Z�_,���g�Ě�:���9����[L2�W=T��0��f�\0P�U6\ns%7isY�?��u�3���nb5�����X|G~l�&�k���M��������y�S��)�]�ܭr��ٸ�������?�}u'n0W-ι��b��Ǫ���k?�vQ�7��}p\n�����ٮZ*�9)��5ޕZW�-ZB���:��㫊W�\0WZfp�Gp���ٮ:�Fp����U��SN/��\\��%s9�S{� �8��Z�as�ۓ�+�N^��9�M�{�P5�� �Q���J���y����;����z����Y�V �3�:�D�I���+����19M;�������V���\rQ{��ծ���+��F�CLĹ�N���Ԉ�\\��)\$i���N'\0���P����]X�^�s1�f�&�\"'<O���̡�L\0�\"�@���%�6��UA�1�i(z��݁�\r�Ղ��bZ��+IQO�3���\r=*ĉ��)�!����`��h��,ЫmGPC��A��ٲ�A��(ZŰ%�t�,h/���i��k���XEJ6�ID�Ȭ\"�\n�aU- ��\nv�y��_���ګ�k	a�B<�V�D�/P���a��)9L�(Z��8�vvù�k	�o�ZXk���|�&�.�東C�����`�1�]7&ę+�H�CBcX�B7xX�|1��0��a�6��ubpJLǅ�(���mbl�8I�*R��@tk0�����xX���;�� al]4s�t��Ū�0�c�'��l�`8M�8����D4w`p?@706g̈~K�\r�� �P���bh�\"&��\n�q�PD����\$�(�0QP<�����Q�!X��x��5���R�`w/2�2#���� `���1�/�܁\r���:²����B7�V7Z��gMY�H3� ��b�	Z��J���G�w�gl�^�-�R-!�l�7̲L��ư<1 �QC/ղh��)�W�6C	�*d��6]VK!m����05G\$�R��4��=Cw&[��YP��dɚ�')VK,�5e�\r���K+�1�X)b�e)��uF2A#E�&g~�e�y�fp5�lYl�Ԝ5�����\n�m}`�(�M �Pl9Y��f����]�Vl-4�é����>`��/��fPE�i�\0k�v�\0�fhS0�&�¦lͼ�#fu���5	i%�:Fd��9��؀G<�	{�}��s[7\0�Ξ3�ft:+.Ȕ�p�>�ձ�@!Pas6q,���1bǬŋ�ZK���-��ar`�?RxX�鑡�V���#Ĥ�z�; �D���H��1��6D`��Y�`�R�P֋>-�!\$�����~π���`>���h�0�1����&\0�h���I�wl�Z�\$�\\\r��8�~,�\n�o_��B2D����a1��ǩ�=�v<�kF�p`�`�kBF�6� ����h��T T֎�	�@?dr�剀J�H@1�G�dn��w���%��JG��0b�Tf]m(�k�qg\\�������ш3vk'�^d��AX��~�W�Vs�*�ʱ�d��M����@?���}�6\\��m9<��i�ݧ��Ԭh�^s}�-�[K�s�q�b��-��OORm8\$�yw��##��@❷\0��ؤ 5F7����X\n��|J�/-S�W!f�� 0�,w��D4١RU�T������ZX�=�`�W\$@�ԥ(�XG��Ҋ��a>�*�Y���\n��\n��!�[mj���0,mu�W@ FX������=��(���b��<!\n\"��83�'��(R��\n>��@�W�r!L�H�k�\r�E\nW��\r��'FH�\$�����m���=�ۥ{LY��&���_\0����#�䔀[�9\0�\"��@8�iK���0�l���p\ng��'qbF��y�c�l@9�(#JU�ݲ�{io���.{�ͳ4�V́�VnF�x���z� Q�ޞ\$kSa~ʨ0s@���%�y@��5H��N�ͦ�@�x�#	ܫ /\\��?<hڂ���I�T��:�3�\n%��");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0!�����M��*)�o��) q��e���#��L�\0;";break;case"cross.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0#�����#\na�Fo~y�.�_wa��1�J�G�L�6]\0\0;";break;case"up.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����MQN\n�}��a8�y�aŶ�\0��\0;";break;case"down.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����M��*)�[W�\\��L&ٜƶ�\0��\0;";break;case"arrow.gif":echo"GIF89a\0\n\0�\0\0������!�\0\0\0,\0\0\0\0\0\n\0\0�i������Ӳ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$jd=file_open_lock(get_temp_dir()."/adminer.version");if($jd)file_write_unlock($jd,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$m,$fc,$nc,$xc,$n,$ld,$rd,$ba,$Qd,$x,$ca,$me,$nf,$Yf,$Dh,$wd,$ki,$qi,$zi,$Fi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_name("adminer_sid");$Lf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Lf[]=true;call_user_func_array('session_set_cookie_params',$Lf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$Wc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$me=array('zh'=>'简体中文',);function
get_lang(){global$ca;return$ca;}function
lang($u,$ef=null){if(is_string($u)){$bg=array_search($u,get_translations("en"));if($bg!==false)$u=$bg;}global$ca,$qi;$pi=($qi[$u]?$qi[$u]:$u);if(is_array($pi)){$bg=($ef==1?0:($ca=='cs'||$ca=='sk'?($ef&&$ef<5?1:2):($ca=='fr'?(!$ef?0:1):($ca=='pl'?($ef%10>1&&$ef%10<5&&$ef/10%10!=1?1:2):($ca=='sl'?($ef%100==1?0:($ef%100==2?1:($ef%100==3||$ef%100==4?2:3))):($ca=='lt'?($ef%10==1&&$ef%100!=11?0:($ef%10>1&&$ef/10%10!=1?1:2)):($ca=='bs'||$ca=='ru'||$ca=='sr'||$ca=='uk'?($ef%10==1&&$ef%100!=11?0:($ef%10>1&&$ef%10<5&&$ef/10%10!=1?1:2)):1)))))));$pi=$pi[$bg];}$Fa=func_get_args();array_shift($Fa);$gd=str_replace("%d","%s",$pi);if($gd!=$pi)$Fa[0]=format_number($ef);return
vsprintf($gd,$Fa);}function
switch_lang(){global$ca,$me;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$me,$ca,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ca="en";if(isset($me[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ca=$_COOKIE["adminer_lang"];}elseif(isset($me[$_SESSION["lang"]]))$ca=$_SESSION["lang"];else{$va=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Ce,PREG_SET_ORDER);foreach($Ce
as$B)$va[$B[1]]=(isset($B[3])?$B[3]:1);arsort($va);foreach($va
as$y=>$rg){if(isset($me[$y])){$ca=$y;break;}$y=preg_replace('~-.*~','',$y);if(!isset($va[$y])&&isset($me[$y])){$ca=$y;break;}}}$qi=$_SESSION["translations"];if($_SESSION["translations_version"]!=3102770556){$qi=array();$_SESSION["translations_version"]=3102770556;}function
get_translations($le){switch($le){case"zh":$wb="�^��s�\\�r����|%��:�\$\nr.���2�r/d�Ȼ[8� S�8�r�!T�\\�s���I4�b�r��ЀJs!Kd�u�e�V���D�X,#!��j6� �:�t\nr���U:.Z�Pˑ.�\rVWd^%�䌵�r�T�Լ�*�s#U�`Qd�u'c(��oF����e3�Nb�`�p2N�S��ӣ:LY�ta~��&6ۊ��r�s���k��{��6�������c(��2��f�q�ЈP:S*@S�^�t*���ΔT���^\\�nNG#y�j\"5M��9�� ��2�x�m8���c�9����ڼź\0�>A~L���6s%I�X��ˊ�:��M(�bx���d�*�b�K��aL��K#�s��X�g)<��<v��q>s��K���tFC���D�!zH�\$��C�*r�e��^�@P�׶L��ѿ���:��8A<��(�ՍØ�7Э��K����Y�n\n�)�QBr�4t�\"�\$j�W��9@@��;��D��L�%�*ݜ�asՓ}^t�I�E�2k�%��|s��ӂI�����1(\\�9\r6�e�h.�Q`r�e�}S�B��9\r���9�� A�RYE��D�&eA�C�O)U�QPr�D��G�C(�0��d;#`�2�U�u^L��}��v� D%��8s���N]��\"�^��9zW%�s\0]`���<�a6K)�\\V��]<D��0ߥB3�H��O�`�0��Ȣ&��<]��!&r��[��7NU�g��Q�T��!QK��\$�/[�6׮`�-Qd��ST�1:A�4�x��G)����uFԵ��9);�٘�5�RaC�Ǆ*7��0�����z�\$��*\r��ۨ!\0�B����c6\r�x��acH9v#�0����Ck�:�a@���,�D�)�NR�I�^�jIm��p���)J�]GU\"hDQ>�\n���ь��ꡎ� !�������P���\0xL�r`��pD�2{������Sw\n�#Qd��:R!�pW�w��բ�~�&�3V��B��u( �`���@4A �@t��9��^üQ��:C�C8/��-(8���@/������m�a����#Q�\r���\0�̨iB'���`�!#Q�_�Q�(E��B�����]�c�2��1����KFT8���R�!���j�Û�wn�ߟ�0kM h2��0Ơ@�k\r,49�b�\\�\"&E����t%z�Vd�\0��D�G���CAG!�\$�5���4�`��<h*�A��:3^�P[\rw��t�S\"0�T�0ta\n	q0&F��rr!����_02��X\0�_��;���D�˜��ut�tt5Ǝ	�Xf?��EX\r\rl[���Kބ�\n���R9�xS\n�ES���yA-�\"�\0!h���B��V�Z��1�8�4��i��Ts��1���S�s�;0T�\rAu�΄U)�h0�C�Z �u,�s\n.+��\n	�8P�T�*�@�-�-�KСj�K@�J���*/�8�b*�Cؓ�uK��9�\0��p\"�����.ܖAN.�Yz�TD7f�\$��6K���eRc���ʩķ�����-E���#��,�(�H��\r���͡x#���8(M\$P��\\2��[��ЗŻ�%�r؃ʶB�iLBoFw��!��������:D�t�U�7C\ra��tx-u���*�Z�G2����d���t\$ �Y��C��9��IB���!(�����EL���>J}94�	�tA���b�s�^�ۇ�n\r�ٱ!v��4D'P�8�����EVD*�&?A�9��)���5h\\���Jy���u\"et�\0^4m�кW�\$H)��B�J·�4ȏ�X�Q&#Q����a�ȡW�퉌�����m	���Jb'L\n�]���A2�G�@��Fd���@R��M��;Wv�#ѐ����J/�.�We[uKdݖ-���s�v�%�TÔ@���+Y���a�]y�yh�LG��.\$1�/�� �u�<֎|urE��b���^.]���0\\xW#Aİ����g�N��Cpqe�~>� ��x�b9���0M� ��9������Zb1c/\$�҇/L�2�t.�	�`��x��u�x%R:I��.lZkP.�4�-܊���.\r����)����w]�۬����0�m�c��?�����X9��Cg��tx���U��ړSj����E�|�_�1s�?��.+�����X�B3�c��d,�I\"\0�n,.O�'M۰�8VT�G����D	r>9}̈.H�\\\n�������G�{��RI�G<���<s�gY-����V��Zi��r�U�<�2�KQz���d��떸,�)�H��\n%T�P%\"��0;�L�h��-��X��Ra^m�\\�AhA ƾ70���λo%\0�*V�/�/YO\"f�'b���P�\$������~�c��a<����BfoY\nO�Ş�P���0���[����N�Мp�[��0��N�-��\r�ʸ,��l���0�S0���ɐ��M����Q\n>-�J�(M\0c��!o%�*.��@id�!�h˫�o��A>�-:벻m�k��\0)��-\n\"l\"�������䋾�a[azԭN���@�`�t`�\rd�? a�5�\\�`��b�Cj��\r��Ai6yC�\n���Z�*6;�j��2�A^pc\"4#�z�%x<�[ �ѱAf��.!�#�გ�C�!#��L����:P�N�1��\r��\r��@��r5c���j��\"�H�A<L�p���i ����X�.\\%��I�o�h.�O�F2C(��ʦ@�6y�HC��p\0Z��Q�T�<�f�-��RT��̵\"��ο,����&d�H-��������#x*AΔY,p�G%�Y�bS��f<�p�\$�[a\n�a\\k�1Rr��^hqF�0��o-o�V/n �K\0	\0�@�	�t\n`�";break;}$qi=array();foreach(explode("\n",lzw_decompress($wb))as$X)$qi[]=(strpos($X,"\t")?explode("\t",$X):$X);return$qi;}if(!$qi){$qi=get_translations($ca);$_SESSION["translations"]=$qi;}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$errno,$error;function
__construct(){global$b;$bg=array_search("SQL",$b->operators);if($bg!==false)unset($b->operators[$bg]);}function
dsn($kc,$V,$F,$vf=array()){try{parent::__construct($kc,$V,$F,$vf);}catch(Exception$Bc){auth_error(h($Bc->getMessage()));}$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->getAttribute(4);}function
query($G,$_i=false){$H=parent::query($G);$this->error="";if(!$H){list(,$this->errno,$this->error)=$this->errorInfo();if(!$this->error)$this->error=lang(21);return
false;}$this->store_result($H);return$H;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($H=null){if(!$H){$H=$this->_result;if(!$H)return
false;}if($H->columnCount()){$H->num_rows=$H->rowCount();return$H;}$this->affected_rows=$H->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$o=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch();return$J[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$J=(object)$this->getColumnMeta($this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=(in_array("blob",(array)$J->flags)?63:0);return$J;}}}$fc=array();class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($R,$L,$Z,$od,$xf=array(),$z=1,$E=0,$jg=false){global$b,$x;$Xd=(count($od)<count($L));$G=$b->selectQueryBuild($L,$Z,$od,$xf,$z,$E);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$z!=""&&$od&&$Xd&&$x=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$L)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($od&&$Xd?"\nGROUP BY ".implode(", ",$od):"").($xf?"\nORDER BY ".implode(", ",$xf):""),($z!=""?+$z:null),($E?$z*$E:0),"\n");$_h=microtime(true);$I=$this->_conn->query($G);if($jg)echo$b->selectQuery($G,$_h,!$I);return$I;}function
delete($R,$tg,$z=0){$G="FROM ".table($R);return
queries("DELETE".($z?limit1($R,$G,$tg):" $G$tg"));}function
update($R,$O,$tg,$z=0,$M="\n"){$Ri=array();foreach($O
as$y=>$X)$Ri[]="$y = $X";$G=table($R)." SET$M".implode(",$M",$Ri);return
queries("UPDATE".($z?limit1($R,$G,$tg,$M):" $G$tg"));}function
insert($R,$O){return
queries("INSERT INTO ".table($R).($O?" (".implode(", ",array_keys($O)).")\nVALUES (".implode(", ",$O).")":" DEFAULT VALUES"));}function
insertUpdate($R,$K,$hg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$bi){}function
convertSearch($u,$X,$o){return$u;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($Vg){return
q($Vg);}function
warnings(){return'';}function
tableHelp($C){}}$fc["sqlite"]="SQLite 3";$fc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$eg=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($Vc){$this->_link=new
SQLite3($Vc);$Ui=$this->_link->version();$this->server_info=$Ui["versionString"];}function
query($G){$H=@$this->_link->query($G);$this->error="";if(!$H){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($H->numColumns())return
new
Min_Result($H);$this->affected_rows=$this->_link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->_link->escapeString($Q)."'":"x'".reset(unpack('H*',$Q))."'");}function
store_result(){return$this->_result;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetchArray();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$U=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$U,"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($Vc){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($Vc);}function
query($G,$_i=false){$Qe=($_i?"unbufferedQuery":"query");$H=@$this->_link->$Qe($G,SQLITE_BOTH,$n);$this->error="";if(!$H){$this->error=$n;return
false;}elseif($H===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($H);}function
quote($Q){return"'".sqlite_escape_string($Q)."'";}function
store_result(){return$this->_result;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetch();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;if(method_exists($H,'numRows'))$this->num_rows=$H->numRows();}function
fetch_assoc(){$J=$this->_result->fetch(SQLITE_ASSOC);if(!$J)return
false;$I=array();foreach($J
as$y=>$X)$I[($y[0]=='"'?idf_unescape($y):$y)]=$X;return$I;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$Xf='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Xf\\.)?$Xf\$~",$C,$B)){$R=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$R,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($Vc){$this->dsn(DRIVER.":$Vc","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($Vc){if(is_readable($Vc)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$Vc)?$Vc:dirname($_SERVER["SCRIPT_FILENAME"])."/$Vc")." AS a")){parent::__construct($Vc);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$hg){$Ri=array();foreach($K
as$O)$Ri[]="(".implode(", ",$O).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($K))).") VALUES\n".implode(",\n",$Ri));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return
lang(22);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){global$g;return(preg_match('~^INTO~',$G)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$M):" $G WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$M."LIMIT 1)");}function
db_collation($l,$pb){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($C=""){global$g;$I=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){$J["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($J["Name"]));$I[$J["Name"]]=$J;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$J)$I[$J["name"]]["Auto_increment"]=$J["seq"];return($C!=""?$I[$C]:$I);}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){global$g;$I=array();$hg="";foreach(get_rows("PRAGMA table_info(".table($R).")")as$J){$C=$J["name"];$U=strtolower($J["type"]);$Tb=$J["dflt_value"];$I[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~'(.*)'~",$Tb,$B)?str_replace("''","'",$B[1]):($Tb=="NULL"?null:$Tb)),"null"=>!$J["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$J["pk"],);if($J["pk"]){if($hg!="")$I[$hg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$I[$C]["auto_increment"]=true;$hg=$C;}}$vh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$vh,$Ce,PREG_SET_ORDER);foreach($Ce
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($I[$C])$I[$C]["collation"]=trim($B[3],"'");}return$I;}function
indexes($R,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$vh=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$vh,$B)){$I[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$Ce,PREG_SET_ORDER);foreach($Ce
as$B){$I[""]["columns"][]=idf_unescape($B[2]).$B[4];$I[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$I){foreach(fields($R)as$C=>$o){if($o["primary"])$I[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$yh=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$h);foreach(get_rows("PRAGMA index_list(".table($R).")",$h)as$J){$C=$J["name"];$v=array("type"=>($J["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$h)as$Ug){$v["columns"][]=$Ug["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$yh[$C],$Eg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Eg[2],$Ce);foreach($Ce[2]as$y=>$X){if($X)$v["descs"][$y]='1';}}if(!$I[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$I[""]["columns"]||$v["descs"]!=$I[""]["descs"]||!preg_match("~^sqlite_~",$C))$I[$C]=$v;}return$I;}function
foreign_keys($R){$I=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$J){$q=&$I[$J["id"]];if(!$q)$q=$J;$q["source"][]=$J["from"];$q["target"][]=$J["to"];}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($C){global$g;$Lc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Lc)\$~",$C)){$g->error=lang(23,str_replace("|",", ",$Lc));return
false;}return
true;}function
create_database($l,$d){global$g;if(file_exists($l)){$g->error=lang(24);return
false;}if(!check_sqlite_name($l))return
false;try{$_=new
Min_SQLite($l);}catch(Exception$Bc){$g->error=$Bc->getMessage();return
false;}$_->query('PRAGMA encoding = "UTF-8"');$_->query('CREATE TABLE adminer (i)');$_->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$g;$g->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$g->error=lang(24);return
false;}}return
true;}function
rename_database($C,$d){global$g;if(!check_sqlite_name($C))return
false;$g->__construct(":memory:");$g->error=lang(24);return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){$Li=($R==""||$dd);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Li=true;break;}}$c=array();$Ff=array();foreach($p
as$o){if($o[1]){$c[]=($Li?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$Ff[$o[0]]=$o[1][0];}}if(!$Li){foreach($c
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$C&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($R,$C,$c,$Ff,$dd))return
false;if($Ma)queries("UPDATE sqlite_sequence SET seq = $Ma WHERE name = ".q($C));return
true;}function
recreate_table($R,$C,$p,$Ff,$dd,$w=array()){if($R!=""){if(!$p){foreach(fields($R)as$y=>$o){if($w)$o["auto_increment"]=0;$p[]=process_field($o,$o);$Ff[$y]=idf_escape($y);}}$ig=false;foreach($p
as$o){if($o[6])$ig=true;}$ic=array();foreach($w
as$y=>$X){if($X[2]=="DROP"){$ic[$X[1]]=true;unset($w[$y]);}}foreach(indexes($R)as$fe=>$v){$f=array();foreach($v["columns"]as$y=>$e){if(!$Ff[$e])continue
2;$f[]=$Ff[$e].($v["descs"][$y]?" DESC":"");}if(!$ic[$fe]){if($v["type"]!="PRIMARY"||!$ig)$w[]=array($v["type"],$fe,$f);}}foreach($w
as$y=>$X){if($X[0]=="PRIMARY"){unset($w[$y]);$dd[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$fe=>$q){foreach($q["source"]as$y=>$e){if(!$Ff[$e])continue
2;$q["source"][$y]=idf_unescape($Ff[$e]);}if(!isset($dd[" $fe"]))$dd[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($p
as$y=>$o)$p[$y]="  ".implode($o);$p=array_merge($p,array_filter($dd));if(!queries("CREATE TABLE ".table($R!=""?"adminer_$C":$C)." (\n".implode(",\n",$p)."\n)"))return
false;if($R!=""){if($Ff&&!queries("INSERT INTO ".table("adminer_$C")." (".implode(", ",$Ff).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Ff)))." FROM ".table($R)))return
false;$wi=array();foreach(triggers($R)as$ui=>$ci){$ti=trigger($ui);$wi[]="CREATE TRIGGER ".idf_escape($ui)." ".implode(" ",$ci)." ON ".table($C)."\n$ti[Statement]";}if(!queries("DROP TABLE ".table($R)))return
false;queries("ALTER TABLE ".table("adminer_$C")." RENAME TO ".table($C));if(!alter_indexes($C,$w))return
false;foreach($wi
as$ti){if(!queries($ti))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$C,$f){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($R."_"))." ON ".table($R)." $f";}function
alter_indexes($R,$c){foreach($c
as$hg){if($hg[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($Wi){return
apply_queries("DROP VIEW",$Wi);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$Wi,$Th){return
false;}function
trigger($C){global$g;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$vi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$vi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$gf=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($gf?" OF":""),"Of"=>($gf[0]=='`'||$gf[0]=='"'?idf_unescape($gf):$gf),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($R){$I=array();$vi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$J){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$vi["Timing"]).')\s*(.*)\s+ON\b~iU',$J["sql"],$B);$I[$J["name"]]=array($B[1],$B[2]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$G){return$g->query("EXPLAIN QUERY PLAN $G");}function
found_rows($S,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Yg){return
true;}function
create_sql($R,$Ma,$Eh){global$g;$I=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$C=>$v){if($C=='')continue;$I.=";\n\n".index_sql($R,$v['type'],$C,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$I;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($j){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){global$g;$I=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$y)$I[$y]=$g->result("PRAGMA $y");return$I;}function
show_status(){$I=array();foreach(get_vals("PRAGMA compile_options")as$uf){list($y,$X)=explode("=",$uf,2);$I[$y]=$X;}return$I;}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Qc){return
preg_match('~^(columns|database|drop_col|dump|indexes|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Qc);}$x="sqlite";$zi=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Dh=array_keys($zi);$Fi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$ld=array("hex","length","lower","round","unixepoch","upper");$rd=array("avg","count","count distinct","group_concat","max","min","sum");$nc=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$fc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$eg=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($yc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($N,$V,$F){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Ui=pg_version($this->_link);$this->server_info=$Ui["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($Q){return"'".pg_escape_string($this->_link,$Q)."'";}function
value($X,$o){return($o["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($Q){return"'".pg_escape_bytea($this->_link,$Q)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$I=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($I)$this->_link=$I;return$I;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$_i=false){$H=@pg_query($this->_link,$G);$this->error="";if(!$H){$this->error=pg_last_error($this->_link);$I=false;}elseif(!pg_num_fields($H)){$this->affected_rows=pg_affected_rows($H);$I=true;}else$I=new
Min_Result($H);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
pg_fetch_result($H->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=pg_num_rows($H);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;if(function_exists('pg_field_table'))$I->orgtable=pg_field_table($this->_result,$e);$I->name=pg_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=pg_field_type($this->_result,$e);$I->charsetnr=($I->type=="bytea"?63:0);return$I;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($N,$V,$F){global$b;$l=$b->database();$Q="pgsql:host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$Q dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($Vg){return
q($Vg);}function
query($G,$_i=false){$I=parent::query($G,$_i);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$I;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$hg){global$g;foreach($K
as$O){$Gi=array();$Z=array();foreach($O
as$y=>$X){$Gi[]="$y = $X";if(isset($hg[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Gi)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).")")))return
false;}return
true;}function
slowQuery($G,$bi){$this->_conn->query("SET statement_timeout = ".(1000*$bi));$this->_conn->timeout=1000*$bi;return$G;}function
convertSearch($u,$X,$o){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$o["type"])?$u:"CAST($u AS text)");}function
quoteBinary($Vg){return$this->_conn->quoteBinary($Vg);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$we=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$_=$we[$_GET["ns"]];if($_)return"$_-".str_replace("_","-",$C).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$zi,$Dh;$g=new
Min_DB;$Hb=$b->credentials();if($g->connect($Hb[0],$Hb[1],$Hb[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Dh[lang(25)][]="json";$zi["json"]=4294967295;if(min_version(9.4,0,$g)){$Dh[lang(25)][]="jsonb";$zi["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$M):" $G".(is_view(table_status1($R))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$M."LIMIT 1)"));}function
db_collation($l,$pb){global$g;return$g->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($k){return
array();}function
table_status($C=""){$I=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", CASE WHEN c.relhasoids THEN 'oid' ELSE '' END AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$J)$I[$J["Name"]]=$J;return($C!=""?$I[$C]:$I);}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$I=array();$Da=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($R)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$J){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$J["full_type"],$B);list(,$U,$te,$J["length"],$xa,$Ga)=$B;$J["length"].=$Ga;$eb=$U.$xa;if(isset($Da[$eb])){$J["type"]=$Da[$eb];$J["full_type"]=$J["type"].$te.$Ga;}else{$J["type"]=$U;$J["full_type"]=$J["type"].$te.$xa.$Ga;}$J["null"]=!$J["attnotnull"];$J["auto_increment"]=preg_match('~^nextval\(~i',$J["default"]);$J["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$J["default"],$B))$J["default"]=($B[1]=="NULL"?null:(($B[1][0]=="'"?idf_unescape($B[1]):$B[1]).$B[2]));$I[$J["field"]]=$J;}return$I;}function
indexes($R,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$Mh=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($R));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Mh AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Mh AND ci.oid = i.indexrelid",$h)as$J){$Fg=$J["relname"];$I[$Fg]["type"]=($J["indispartial"]?"INDEX":($J["indisprimary"]?"PRIMARY":($J["indisunique"]?"UNIQUE":"INDEX")));$I[$Fg]["columns"]=array();foreach(explode(" ",$J["indkey"])as$Md)$I[$Fg]["columns"][]=$f[$Md];$I[$Fg]["descs"]=array();foreach(explode(" ",$J["indoption"])as$Nd)$I[$Fg]["descs"][]=($Nd&1?'1':null);$I[$Fg]["lengths"]=array();}return$I;}function
foreign_keys($R){global$nf;$I=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($R)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$J){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$J['definition'],$B)){$J['source']=array_map('trim',explode(',',$B[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$Be)){$J['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Be[2]));$J['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Be[4]));}$J['target']=array_map('trim',explode(',',$B[3]));$J['on_delete']=(preg_match("~ON DELETE ($nf)~",$B[4],$Be)?$Be[1]:'NO ACTION');$J['on_update']=(preg_match("~ON UPDATE ($nf)~",$B[4],$Be)?$Be[1]:'NO ACTION');$I[$J['conname']]=$J;}}return$I;}function
view($C){global$g;return
array("select"=>trim($g->result("SELECT view_definition
FROM information_schema.views
WHERE table_schema = current_schema() AND table_name = ".q($C))));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$g;$I=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$I,$B))$I=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($I);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$g;$g->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($C,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){$c=array();$sg=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$Qi=$X[5];unset($X[5]);if(isset($X[6])&&$o[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($o[0]=="")$c[]=($R!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$sg[]="ALTER TABLE ".table($R)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($o[0]!=""||$Qi!="")$sg[]="COMMENT ON COLUMN ".table($R).".$X[0] IS ".($Qi!=""?substr($Qi,9):"''");}}$c=array_merge($c,$dd);if($R=="")array_unshift($sg,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($sg,"ALTER TABLE ".table($R)."\n".implode(",\n",$c));if($R!=""&&$R!=$C)$sg[]="ALTER TABLE ".table($R)." RENAME TO ".table($C);if($R!=""||$ub!="")$sg[]="COMMENT ON TABLE ".table($C)." IS ".q($ub);if($Ma!=""){}foreach($sg
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($R,$c){$i=array();$gc=array();$sg=array();foreach($c
as$X){if($X[0]!="INDEX")$i[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$gc[]=idf_escape($X[1]);else$sg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($i)array_unshift($sg,"ALTER TABLE ".table($R).implode(",",$i));if($gc)array_unshift($sg,"DROP INDEX ".implode(", ",$gc));foreach($sg
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('table',$T)));return
true;}function
drop_views($Wi){return
drop_tables($Wi);}function
drop_tables($T){foreach($T
as$R){$P=table_status($R);if(!queries("DROP ".strtoupper($P["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$Wi,$Th){foreach(array_merge($T,$Wi)as$R){$P=table_status($R);if(!queries("ALTER ".strtoupper($P["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($Th)))return
false;}return
true;}function
trigger($C,$R=null){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($R===null)$R=$_GET['trigger'];$K=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($R).' AND t.trigger_name = '.q($C));return
reset($K);}function
triggers($R){$I=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($R))as$J)$I[$J["trigger_name"]]=array($J["action_timing"],$J["event_manipulation"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$U){$K=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$I=$K[0];$I["returns"]=array("type"=>$I["type_udt_name"]);$I["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$I;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$J){$I=array();foreach($J["fields"]as$o)$I[]=$o["type"];return
idf_escape($C)."(".implode(", ",$I).")";}function
last_id(){return
0;}function
explain($g,$G){return$g->query("EXPLAIN $G");}function
found_rows($S,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Eg))return$Eg[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($Xg){global$g,$zi,$Dh;$I=$g->query("SET search_path TO ".idf_escape($Xg));foreach(types()as$U){if(!isset($zi[$U])){$zi[$U]=0;$Dh[lang(26)][]=$U;}}return$I;}function
create_sql($R,$Ma,$Eh){global$g;$I='';$Ng=array();$hh=array();$P=table_status($R);$p=fields($R);$w=indexes($R);ksort($w);$ad=foreign_keys($R);ksort($ad);if(!$P||empty($p))return
false;$I="CREATE TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." (\n    ";foreach($p
as$Sc=>$o){$Of=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$Ng[]=$Of;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$Ce)){$gh=$Ce[1];$uh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($gh):"SELECT * FROM $gh"));$hh[]=($Eh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $gh;\n":"")."CREATE SEQUENCE $gh INCREMENT $uh[increment_by] MINVALUE $uh[min_value] MAXVALUE $uh[max_value] START ".($Ma?$uh['last_value']:1)." CACHE $uh[cache_value];";}}if(!empty($hh))$I=implode("\n\n",$hh)."\n\n$I";foreach($w
as$Hd=>$v){switch($v['type']){case'UNIQUE':$Ng[]="CONSTRAINT ".idf_escape($Hd)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$Ng[]="CONSTRAINT ".idf_escape($Hd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($ad
as$Zc=>$Yc)$Ng[]="CONSTRAINT ".idf_escape($Zc)." $Yc[definition] ".($Yc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$I.=implode(",\n    ",$Ng)."\n) WITH (oids = ".($P['Oid']?'true':'false').");";foreach($w
as$Hd=>$v){if($v['type']=='INDEX')$I.="\n\nCREATE INDEX ".idf_escape($Hd)." ON ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." USING btree (".implode(', ',array_map('idf_escape',$v['columns'])).");";}if($P['Comment'])$I.="\n\nCOMMENT ON TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." IS ".q($P['Comment']).";";foreach($p
as$Sc=>$o){if($o['comment'])$I.="\n\nCOMMENT ON COLUMN ".idf_escape($P['nspname']).".".idf_escape($P['Name']).".".idf_escape($Sc)." IS ".q($o['comment']).";";}return
rtrim($I,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$P=table_status($R);$I="";foreach(triggers($R)as$si=>$ri){$ti=trigger($si,$P['Name']);$I.="\nCREATE TRIGGER ".idf_escape($ti['Trigger'])." $ti[Timing] $ti[Events] ON ".idf_escape($P["nspname"]).".".idf_escape($P['Name'])." $ti[Type] $ti[Statement];;\n";}return$I;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Qc){return
preg_match('~^(database|table|columns|sql|indexes|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Qc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}$x="pgsql";$zi=array();$Dh=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(25)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$y=>$X){$zi+=$X;$Dh[$y]=array_keys($X);}$Fi=array();$sf=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$ld=array("char_length","lower","round","to_hex","to_timestamp","upper");$rd=array("avg","count","count distinct","max","min","sum");$nc=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$fc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$eg=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($yc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($N,$V,$F){$this->_link=@oci_new_connect($V,$F,$N,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return
true;}function
query($G,$_i=false){$H=oci_parse($this->_link,$G);$this->error="";if(!$H){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$I=@oci_execute($H);restore_error_handler();if($I){if(oci_num_fields($H))return
new
Min_Result($H);$this->affected_rows=oci_num_rows($H);}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=1){$H=$this->query($G);if(!is_object($H)||!oci_fetch($H->_result))return
false;return
oci_result($H->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$y=>$X){if(is_a($X,'OCI-Lob'))$J[$y]=$X->load();}return$J;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;$I->name=oci_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=oci_field_type($this->_result,$e);$I->charsetnr=(preg_match("~raw|blob|bfile~",$I->type)?63:0);return$I;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($N,$V,$F){$this->dsn("oci:dbname=//$N;charset=AL32UTF8",$V,$F);return
true;}function
select_db($j){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Hb=$b->credentials();if($g->connect($Hb[0],$Hb[1],$Hb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($G,$Z,$z,$D=0,$M=" "){return($D?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($z+$D).") WHERE rnum > $D":($z!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($z+$D):" $G$Z"));}function
limit1($R,$G,$Z,$M="\n"){return" $G$Z";}function
db_collation($l,$pb){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($k){return
array();}function
table_status($C=""){$I=array();$Zg=q($C);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($C!=""?" AND table_name = $Zg":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($C!=""?" WHERE view_name = $Zg":"")."
ORDER BY 1")as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$I=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)." ORDER BY column_id")as$J){$U=$J["DATA_TYPE"];$te="$J[DATA_PRECISION],$J[DATA_SCALE]";if($te==",")$te=$J["DATA_LENGTH"];$I[$J["COLUMN_NAME"]]=array("field"=>$J["COLUMN_NAME"],"full_type"=>$U.($te?"($te)":""),"type"=>strtolower($U),"length"=>$te,"default"=>$J["DATA_DEFAULT"],"null"=>($J["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($R)."
ORDER BY uc.constraint_type, uic.column_position",$h)as$J){$Hd=$J["INDEX_NAME"];$I[$Hd]["type"]=($J["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($J["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$I[$Hd]["columns"][]=$J["COLUMN_NAME"];$I[$Hd]["lengths"][]=($J["CHAR_LENGTH"]&&$J["CHAR_LENGTH"]!=$J["COLUMN_LENGTH"]?$J["CHAR_LENGTH"]:null);$I[$Hd]["descs"][]=($J["DESCEND"]?'1':null);}return$I;}function
view($C){$K=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($C));return
reset($K);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$G){$g->query("EXPLAIN PLAN FOR $G");return$g->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){$c=$gc=array();foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");if($X)$c[]=($R!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$gc[]=idf_escape($o[0]);}if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($R)."\n".implode("\n",$c)))&&(!$gc||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$gc).")"))&&($R==$C||queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)));}function
foreign_keys($R){$I=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($G)as$J)$I[$J['NAME']]=array("db"=>$J['DEST_DB'],"table"=>$J['DEST_TABLE'],"source"=>array($J['SRC_COLUMN']),"target"=>array($J['DEST_COLUMN']),"on_delete"=>$J['ON_DELETE'],"on_update"=>null,);return$I;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Wi){return
apply_queries("DROP VIEW",$Wi);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Yg){global$g;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Yg));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$K=get_rows('SELECT * FROM v$instance');return
reset($K);}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Qc){return
preg_match('~^(columns|database|drop_col|indexes|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$Qc);}$x="oracle";$zi=array();$Dh=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(25)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$y=>$X){$zi+=$X;$Dh[$y]=array_keys($X);}$Fi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$ld=array("length","lower","round","upper");$rd=array("avg","count","count distinct","max","min","sum");$nc=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$fc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$eg=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($N,$V,$F){$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$N),array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8"));if($this->_link){$Od=sqlsrv_server_info($this->_link);$this->server_info=$Od['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($G,$_i=false){$H=sqlsrv_query($this->_link,$G);$this->error="";if(!$H){$this->_get_error();return
false;}return$this->store_result($H);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($H=null){if(!$H)$H=$this->_result;if(!$H)return
false;if(sqlsrv_field_metadata($H))return
new
Min_Result($H);$this->affected_rows=sqlsrv_rows_affected($H);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->fetch_row();return$J[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$y=>$X){if(is_a($X,'DateTime'))$J[$y]=$X->format("Y-m-d H:i:s");}return$J;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$I=new
stdClass;$I->name=$o["Name"];$I->orgname=$o["Name"];$I->type=($o["Type"]==1?254:0);return$I;}function
seek($D){for($s=0;$s<$D;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($N,$V,$F){$this->_link=@mssql_connect($N,$V,$F);if($this->_link){$H=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($H){$J=$H->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$J[0]] $J[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($G,$_i=false){$H=@mssql_query($G,$this->_link);$this->error="";if(!$H){$this->error=mssql_get_last_message();return
false;}if($H===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$o=0){$H=$this->query($G);if(!is_object($H))return
false;return
mssql_result($H->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=mssql_num_rows($H);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$I=mssql_fetch_field($this->_result);$I->orgtable=$I->table;$I->orgname=$I->name;return$I;}function
seek($D){mssql_data_seek($this->_result,$D);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($N,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$K,$hg){foreach($K
as$O){$Gi=array();$Z=array();foreach($O
as$y=>$X){$Gi[]="$y = $X";if(isset($hg[idf_unescape($y)]))$Z[]="$y = $X";}if(!queries("MERGE ".table($R)." USING (VALUES(".implode(", ",$O).")) AS source (c".implode(", c",range(1,count($O))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Gi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Hb=$b->credentials();if($g->connect($Hb[0],$Hb[1],$Hb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$z,$D=0,$M=" "){return($z!==null?" TOP (".($z+$D).")":"")." $G$Z";}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$pb){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$g;$I=array();foreach($k
as$l){$g->select_db($l);$I[$l]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$I;}function
table_status($C=""){$I=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$I=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($R))as$J){$U=$J["type"];$te=(preg_match("~char|binary~",$U)?$J["max_length"]:($U=="decimal"?"$J[precision],$J[scale]":""));$I[$J["name"]]=array("field"=>$J["name"],"full_type"=>$U.($te?"($te)":""),"type"=>$U,"length"=>$te,"default"=>$J["default"],"null"=>$J["is_nullable"],"auto_increment"=>$J["is_identity"],"collation"=>$J["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$J["is_identity"],);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$h)as$J){$C=$J["name"];$I[$C]["type"]=($J["is_primary_key"]?"PRIMARY":($J["is_unique"]?"UNIQUE":"INDEX"));$I[$C]["lengths"]=array();$I[$C]["columns"][$J["key_ordinal"]]=$J["column_name"];$I[$C]["descs"][$J["key_ordinal"]]=($J["is_descending_key"]?'1':null);}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$I=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$I[preg_replace('~_.*~','',$d)][]=$d;return$I;}function
information_schema($l){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($C,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){$c=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($R==""?substr($dd[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($R).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($R=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($R!=$C)queries("EXEC sp_rename ".q(table($R)).", ".q($C));if($dd)$c[""]=$dd;foreach($c
as$y=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $y".implode(",",$X)))return
false;}return
true;}function
alter_indexes($R,$c){$v=array();$gc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$gc[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$gc||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$gc)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$G){$g->query("SET SHOWPLAN_ALL ON");$I=$g->query($G);$g->query("SET SHOWPLAN_ALL OFF");return$I;}function
found_rows($S,$Z){}function
foreign_keys($R){$I=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R))as$J){$q=&$I[$J["FK_NAME"]];$q["table"]=$J["PKTABLE_NAME"];$q["source"][]=$J["FKCOLUMN_NAME"];$q["target"][]=$J["PKCOLUMN_NAME"];}return$I;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Wi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Wi)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Wi,$Th){return
apply_queries("ALTER SCHEMA ".idf_escape($Th)." TRANSFER",array_merge($T,$Wi));}function
trigger($C){if($C=="")return
array();$K=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$I=reset($K);if($I)$I["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$I["text"]);return$I;}function
triggers($R){$I=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$J)$I[$J["name"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($Xg){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
support($Qc){return
preg_match('~^(columns|database|drop_col|indexes|scheme|sql|table|trigger|view|view_trigger)$~',$Qc);}$x="mssql";$zi=array();$Dh=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(25)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$y=>$X){$zi+=$X;$Dh[$y]=array_keys($X);}$Fi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$ld=array("len","lower","round","upper");$rd=array("avg","count","count distinct","max","min","sum");$nc=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$fc['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$eg=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){$this->_link=ibase_connect($N,$V,$F);if($this->_link){$Ji=explode(':',$N);$this->service_link=ibase_service_attach($Ji[0],$V,$F);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($j){return($j=="domain");}function
query($G,$_i=false){$H=ibase_query($G,$this->_link);if(!$H){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($H===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;$J=$H->fetch_row();return$J[$o];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$o=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$o['name'],'orgname'=>$o['name'],'type'=>$o['type'],'charsetnr'=>$o['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Hb=$b->credentials();if($g->connect($Hb[0],$Hb[1],$Hb[2]))return$g;return$g->error;}function
get_databases($bd){return
array("domain");}function
limit($G,$Z,$z,$D=0,$M=" "){$I='';$I.=($z!==null?$M."FIRST $z".($D?" SKIP $D":""):"");$I.=" $G$Z";return$I;}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$pb){}function
engines(){return
array();}function
logged_user(){global$b;$Hb=$b->credentials();return$Hb[1];}function
tables_list(){global$g;$G='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$H=ibase_query($g->_link,$G);$I=array();while($J=ibase_fetch_assoc($H))$I[$J['RDB$RELATION_NAME']]='table';ksort($I);return$I;}function
count_tables($k){return
array();}function
table_status($C="",$Pc=false){global$g;$I=array();$Mb=tables_list();foreach($Mb
as$v=>$X){$v=trim($v);$I[$v]=array('Name'=>$v,'Engine'=>'standard',);if($C==$v)return$I[$v];}return$I;}function
is_view($S){return
false;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"]);}function
fields($R){global$g;$I=array();$G='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($R).'
ORDER BY r.RDB$FIELD_POSITION';$H=ibase_query($g->_link,$G);while($J=ibase_fetch_assoc($H))$I[trim($J['FIELD_NAME'])]=array("field"=>trim($J["FIELD_NAME"]),"full_type"=>trim($J["FIELD_TYPE"]),"type"=>trim($J["FIELD_SUB_TYPE"]),"default"=>trim($J['FIELD_DEFAULT_VALUE']),"null"=>(trim($J["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($J["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($J["FIELD_DESCRIPTION"]),);return$I;}function
indexes($R,$h=null){$I=array();return$I;}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
support($Qc){return
preg_match("~^(columns|sql|status|table)$~",$Qc);}$x="firebird";$sf=array("=");$ld=array();$rd=array();$nc=array();}$fc["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$eg=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($j){return($j=="domain");}function
query($G,$_i=false){$Lf=array('SelectExpression'=>$G,'ConsistentRead'=>'true');if($this->next)$Lf['NextToken']=$this->next;$H=sdb_request_all('Select','Item',$Lf,$this->timeout);$this->timeout=0;if($H===false)return$H;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$G)){$Hh=0;foreach($H
as$ae)$Hh+=$ae->Attribute->Value;$H=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Hh,))));}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($H){foreach($H
as$ae){$J=array();if($ae->Name!='')$J['itemName()']=(string)$ae->Name;foreach($ae->Attribute
as$Ja){$C=$this->_processValue($Ja->Name);$Y=$this->_processValue($Ja->Value);if(isset($J[$C])){$J[$C]=(array)$J[$C];$J[$C][]=$Y;}else$J[$C]=$Y;}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($qc){return(is_object($qc)&&$qc['encoding']=='base64'?base64_decode($qc):(string)$qc);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ge=array_keys($this->_rows[0]);return(object)array('name'=>$ge[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$hg="itemName()";function
_chunkRequest($Ed,$wa,$Lf,$Fc=array()){global$g;foreach(array_chunk($Ed,25)as$ib){$Mf=$Lf;foreach($ib
as$s=>$t){$Mf["Item.$s.ItemName"]=$t;foreach($Fc
as$y=>$X)$Mf["Item.$s.$y"]=$X;}if(!sdb_request($wa,$Mf))return
false;}$g->affected_rows=count($Ed);return
true;}function
_extractIds($R,$tg,$z){$I=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$tg,$Ce))$I=array_map('idf_unescape',$Ce[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($R).$tg.($z?" LIMIT 1":"")))as$ae)$I[]=$ae->Name;}return$I;}function
select($R,$L,$Z,$od,$xf=array(),$z=1,$E=0,$jg=false){global$g;$g->next=$_GET["next"];$I=parent::select($R,$L,$Z,$od,$xf,$z,$E,$jg);$g->next=0;return$I;}function
delete($R,$tg,$z=0){return$this->_chunkRequest($this->_extractIds($R,$tg,$z),'BatchDeleteAttributes',array('DomainName'=>$R));}function
update($R,$O,$tg,$z=0,$M="\n"){$Vb=array();$Sd=array();$s=0;$Ed=$this->_extractIds($R,$tg,$z);$t=idf_unescape($O["`itemName()`"]);unset($O["`itemName()`"]);foreach($O
as$y=>$X){$y=idf_unescape($y);if($X=="NULL"||($t!=""&&array($t)!=$Ed))$Vb["Attribute.".count($Vb).".Name"]=$y;if($X!="NULL"){foreach((array)$X
as$ce=>$W){$Sd["Attribute.$s.Name"]=$y;$Sd["Attribute.$s.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$ce)$Sd["Attribute.$s.Replace"]="true";$s++;}}}$Lf=array('DomainName'=>$R);return(!$Sd||$this->_chunkRequest(($t!=""?array($t):$Ed),'BatchPutAttributes',$Lf,$Sd))&&(!$Vb||$this->_chunkRequest($Ed,'BatchDeleteAttributes',$Lf,$Vb));}function
insert($R,$O){$Lf=array("DomainName"=>$R);$s=0;foreach($O
as$C=>$Y){if($Y!="NULL"){$C=idf_unescape($C);if($C=="itemName()")$Lf["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$Lf["Attribute.$s.Name"]=$C;$Lf["Attribute.$s.Value"]=(is_array($Y)?$X:idf_unescape($Y));$s++;}}}}return
sdb_request('PutAttributes',$Lf);}function
insertUpdate($R,$K,$hg){foreach($K
as$O){if(!$this->update($R,$O,"WHERE `itemName()` = ".q($O["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($G,$bi){$this->_conn->timeout=$bi;return$G;}}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return
lang(22);return
new
Min_DB;}function
support($Qc){return
preg_match('~sql~',$Qc);}function
logged_user(){global$b;$Hb=$b->credentials();return$Hb[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($l,$pb){}function
tables_list(){global$g;$I=array();foreach(sdb_request_all('ListDomains','DomainName')as$R)$I[(string)$R]='table';if($g->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$I;}function
table_status($C="",$Pc=false){$I=array();foreach(($C!=""?array($C=>true):tables_list())as$R=>$U){$J=array("Name"=>$R,"Auto_increment"=>"");if(!$Pc){$Pe=sdb_request('DomainMetadata',array('DomainName'=>$R));if($Pe){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$y=>$X)$J[$y]=(string)$Pe->$X;}}if($C!="")return$J;$I[$R]=$J;}return$I;}function
explain($g,$G){}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($R){return
fields_from_edit();}function
foreign_keys($R){return
array();}function
table($u){return
idf_escape($u);}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z":"");}function
unconvert_field($o,$I){return$I;}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){return($R==""&&sdb_request('CreateDomain',array('DomainName'=>$C)));}function
drop_tables($T){foreach($T
as$R){if(!sdb_request('DeleteDomain',array('DomainName'=>$R)))return
false;}return
true;}function
count_tables($k){foreach($k
as$l)return
array($l=>count(tables_list()));}function
found_rows($S,$Z){return($Z?null:$S["Rows"]);}function
last_id(){}function
hmac($Ca,$Mb,$y,$xg=false){$Va=64;if(strlen($y)>$Va)$y=pack("H*",$Ca($y));$y=str_pad($y,$Va,"\0");$de=$y^str_repeat("\x36",$Va);$ee=$y^str_repeat("\x5C",$Va);$I=$Ca($ee.pack("H*",$Ca($de.$Mb)));if($xg)$I=pack("H*",$I);return$I;}function
sdb_request($wa,$Lf=array()){global$b,$g;list($Bd,$Lf['AWSAccessKeyId'],$ah)=$b->credentials();$Lf['Action']=$wa;$Lf['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$Lf['Version']='2009-04-15';$Lf['SignatureVersion']=2;$Lf['SignatureMethod']='HmacSHA1';ksort($Lf);$G='';foreach($Lf
as$y=>$X)$G.='&'.rawurlencode($y).'='.rawurlencode($X);$G=str_replace('%7E','~',substr($G,1));$G.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Bd)."\n/\n$G",$ah,true)));@ini_set('track_errors',1);$Uc=@file_get_contents((preg_match('~^https?://~',$Bd)?$Bd:"http://$Bd"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$G,'ignore_errors'=>1,))));if(!$Uc){$g->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$jj=simplexml_load_string($Uc);if(!$jj){$n=libxml_get_last_error();$g->error=$n->message;return
false;}if($jj->Errors){$n=$jj->Errors->Error;$g->error="$n->Message ($n->Code)";return
false;}$g->error='';$Sh=$wa."Result";return($jj->$Sh?$jj->$Sh:true);}function
sdb_request_all($wa,$Sh,$Lf=array(),$bi=0){$I=array();$_h=($bi?microtime(true):0);$z=(preg_match('~LIMIT\s+(\d+)\s*$~i',$Lf['SelectExpression'],$B)?$B[1]:0);do{$jj=sdb_request($wa,$Lf);if(!$jj)break;foreach($jj->$Sh
as$qc)$I[]=$qc;if($z&&count($I)>=$z){$_GET["next"]=$jj->NextToken;break;}if($bi&&microtime(true)-$_h>$bi)return
false;$Lf['NextToken']=$jj->NextToken;if($z)$Lf['SelectExpression']=preg_replace('~\d+\s*$~',$z-count($I),$Lf['SelectExpression']);}while($jj->NextToken);return$I;}$x="simpledb";$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$ld=array();$rd=array("count");$nc=array(array("json"));}$fc["mongo"]="MongoDB";if(isset($_GET["mongo"])){$eg=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Hi,$vf){return@new
MongoClient($Hi,$vf);}function
query($G){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$Bc){$this->error=$Bc->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$ae){$J=array();foreach($ae
as$y=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$y]=63;$J[$y]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ge=array_keys($this->_rows[0]);$C=$ge[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$hg="_id";function
select($R,$L,$Z,$od,$xf=array(),$z=1,$E=0,$jg=false){$L=($L==array("*")?array():array_fill_keys($L,true));$rh=array();foreach($xf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Eb);$rh[$X]=($Eb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($R)->find(array(),$L)->sort($rh)->limit($z!=""?+$z:0)->skip($E*$z));}function
insert($R,$O){try{$I=$this->_conn->_db->selectCollection($R)->insert($O);$this->_conn->errno=$I['code'];$this->_conn->error=$I['err'];$this->_conn->last_id=$O['_id'];return!$I['err'];}catch(Exception$Bc){$this->_conn->error=$Bc->getMessage();return
false;}}}function
get_databases($bd){global$g;$I=array();$Rb=$g->_link->listDBs();foreach($Rb['databases']as$l)$I[]=$l['name'];return$I;}function
count_tables($k){global$g;$I=array();foreach($k
as$l)$I[$l]=count($g->_link->selectDB($l)->getCollectionNames(true));return$I;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$g;foreach($k
as$l){$Jg=$g->_link->selectDB($l)->drop();if(!$Jg['ok'])return
false;}return
true;}function
indexes($R,$h=null){global$g;$I=array();foreach($g->_db->selectCollection($R)->getIndexInfo()as$v){$Yb=array();foreach($v["key"]as$e=>$U)$Yb[]=($U==-1?'1':null);$I[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$Yb,);}return$I;}function
fields($R){return
fields_from_edit();}function
found_rows($S,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$sf=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Hi,$vf){$kb='MongoDB\Driver\Manager';return
new$kb($Hi,$vf);}function
query($G){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$ae){$J=array();foreach($ae
as$y=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$y]=63;$J[$y]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$J;foreach($J
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=$H->count;}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$y=>$X)$I[$y]=$J[$y];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ge=array_keys($this->_rows[0]);$C=$ge[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$hg="_id";function
select($R,$L,$Z,$od,$xf=array(),$z=1,$E=0,$jg=false){global$g;$L=($L==array("*")?array():array_fill_keys($L,1));if(count($L)&&!isset($L['_id']))$L['_id']=0;$Z=where_to_query($Z);$rh=array();foreach($xf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Eb);$rh[$X]=($Eb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$z=$_GET['limit'];$z=min(200,max(1,(int)$z));$oh=$E*$z;$kb='MongoDB\Driver\Query';$G=new$kb($Z,array('projection'=>$L,'limit'=>$z,'skip'=>$oh,'sort'=>$rh));$Mg=$g->_link->executeQuery("$g->_db_name.$R",$G);return
new
Min_Result($Mg);}function
update($R,$O,$tg,$z=0,$M="\n"){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($tg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($O['_id']))unset($O['_id']);$Gg=array();foreach($O
as$y=>$Y){if($Y=='NULL'){$Gg[$y]=1;unset($O[$y]);}}$Gi=array('$set'=>$O);if(count($Gg))$Gi['$unset']=$Gg;$Za->update($Z,$Gi,array('upsert'=>false));$Mg=$g->_link->executeBulkWrite("$l.$R",$Za);$g->affected_rows=$Mg->getModifiedCount();return
true;}function
delete($R,$tg,$z=0){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($tg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());$Za->delete($Z,array('limit'=>$z));$Mg=$g->_link->executeBulkWrite("$l.$R",$Za);$g->affected_rows=$Mg->getDeletedCount();return
true;}function
insert($R,$O){global$g;$l=$g->_db_name;$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($O['_id'])&&empty($O['_id']))unset($O['_id']);$Za->insert($O);$Mg=$g->_link->executeBulkWrite("$l.$R",$Za);$g->affected_rows=$Mg->getInsertedCount();return
true;}}function
get_databases($bd){global$g;$I=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listDatabases'=>1));$Mg=$g->_link->executeCommand('admin',$sb);foreach($Mg
as$Rb){foreach($Rb->databases
as$l)$I[]=$l->name;}return$I;}function
count_tables($k){$I=array();return$I;}function
tables_list(){global$g;$kb='MongoDB\Driver\Command';$sb=new$kb(array('listCollections'=>1));$Mg=$g->_link->executeCommand($g->_db_name,$sb);$qb=array();foreach($Mg
as$H)$qb[$H->name]='table';return$qb;}function
drop_databases($k){return
false;}function
indexes($R,$h=null){global$g;$I=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listIndexes'=>$R));$Mg=$g->_link->executeCommand($g->_db_name,$sb);foreach($Mg
as$v){$Yb=array();$f=array();foreach(get_object_vars($v->key)as$e=>$U){$Yb[]=($U==-1?'1':null);$f[]=$e;}$I[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Yb,);}return$I;}function
fields($R){$p=fields_from_edit();if(!count($p)){global$m;$H=$m->select($R,array("*"),null,null,array(),10);while($J=$H->fetch_assoc()){foreach($J
as$y=>$X){$J[$y]=null;$p[$y]=array("field"=>$y,"type"=>"string","null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$p;}function
found_rows($S,$Z){global$g;$Z=where_to_query($Z);$kb='MongoDB\Driver\Command';$sb=new$kb(array('count'=>$S['Name'],'query'=>$Z));$Mg=$g->_link->executeCommand($g->_db_name,$sb);$ji=$Mg->toArray();return$ji[0]->n;}function
sql_query_where_parser($tg){$tg=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$tg));$tg=preg_replace('/\)\)\)$/',')',$tg);$gj=explode(' AND ',$tg);$hj=explode(') OR (',$tg);$Z=array();foreach($gj
as$ej)$Z[]=trim($ej);if(count($hj)==1)$hj=array();elseif(count($hj)>1)$Z=array();return
where_to_query($Z,$hj);}function
where_to_query($cj=array(),$dj=array()){global$b;$Mb=array();foreach(array('and'=>$cj,'or'=>$dj)as$U=>$Z){if(is_array($Z)){foreach($Z
as$Ic){list($nb,$qf,$X)=explode(" ",$Ic,3);if($nb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$kb='MongoDB\BSON\ObjectID';$X=new$kb($X);}if(!in_array($qf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$qf,$B)){$X=(float)$X;$qf=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$qf,$B)){$Ob=new
DateTime($X);$kb='MongoDB\BSON\UTCDatetime';$X=new$kb($Ob->getTimestamp()*1000);$qf=$B[1];}switch($qf){case'=':$qf='$eq';break;case'!=':$qf='$ne';break;case'>':$qf='$gt';break;case'<':$qf='$lt';break;case'>=':$qf='$gte';break;case'<=':$qf='$lte';break;case'regex':$qf='$regex';break;default:continue;}if($U=='and')$Mb['$and'][]=array($nb=>array($qf=>$X));elseif($U=='or')$Mb['$or'][]=array($nb=>array($qf=>$X));}}}return$Mb;}$sf=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($C="",$Pc=false){$I=array();foreach(tables_list()as$R=>$U){$I[$R]=array("Name"=>$R);if($C==$R)return$I[$R];}return$I;}function
create_database($l,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$Hb=$b->credentials();return$Hb[1];}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();$vf=array();if($V.$F!=""){$vf["username"]=$V;$vf["password"]=$F;}$l=$b->database();if($l!="")$vf["db"]=$l;try{$g->_link=$g->connect("mongodb://$N",$vf);if($F!=""){$vf["password"]="";try{$g->connect("mongodb://$N",$vf);return
lang(22);}catch(Exception$Bc){}}return$g;}catch(Exception$Bc){return$Bc->getMessage();}}function
alter_indexes($R,$c){global$g;foreach($c
as$X){list($U,$C,$O)=$X;if($O=="DROP")$I=$g->_db->command(array("deleteIndexes"=>$R,"index"=>$C));else{$f=array();foreach($O
as$e){$e=preg_replace('~ DESC$~','',$e,1,$Eb);$f[$e]=($Eb?-1:1);}$I=$g->_db->selectCollection($R)->ensureIndex($f,array("unique"=>($U=="UNIQUE"),"name"=>$C,));}if($I['errmsg']){$g->error=$I['errmsg'];return
false;}}return
true;}function
support($Qc){return
preg_match("~database|indexes~",$Qc);}function
db_collation($l,$pb){}function
information_schema(){}function
is_view($S){}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
foreign_keys($R){return
array();}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){global$g;if($R==""){$g->_db->createCollection($C);return
true;}}function
drop_tables($T){global$g;foreach($T
as$R){$Jg=$g->_db->selectCollection($R)->drop();if(!$Jg['ok'])return
false;}return
true;}function
truncate_tables($T){global$g;foreach($T
as$R){$Jg=$g->_db->selectCollection($R)->remove();if(!$Jg['ok'])return
false;}return
true;}$x="mongo";$ld=array();$rd=array();$nc=array(array("json"));}$fc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$eg=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($Vf,$_b=array(),$Qe='GET'){@ini_set('track_errors',1);$Uc=@file_get_contents("$this->_url/".ltrim($Vf,'/'),false,stream_context_create(array('http'=>array('method'=>$Qe,'content'=>$_b===null?$_b:json_encode($_b),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Uc){$this->error=$php_errormsg;return$Uc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$Uc;return
false;}$I=json_decode($Uc,true);if($I===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$zb=get_defined_constants(true);foreach($zb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return$I;}function
query($Vf,$_b=array(),$Qe='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Vf,'/'),$_b,$Qe);}function
connect($N,$V,$F){preg_match('~^(https?://)?(.*)~',$N,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$F@$B[2]";$I=$this->query('');if($I)$this->server_info=$I['version']['number'];return(bool)$I;}function
select_db($j){$this->_db=$j;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows;function
__construct($K){$this->num_rows=count($this->_rows);$this->_rows=$K;reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($R,$L,$Z,$od,$xf=array(),$z=1,$E=0,$jg=false){global$b;$Mb=array();$G="$R/_search";if($L!=array("*"))$Mb["fields"]=$L;if($xf){$rh=array();foreach($xf
as$nb){$nb=preg_replace('~ DESC$~','',$nb,1,$Eb);$rh[]=($Eb?array($nb=>"desc"):$nb);}$Mb["sort"]=$rh;}if($z){$Mb["size"]=+$z;if($E)$Mb["from"]=($E*$z);}foreach($Z
as$X){list($nb,$qf,$X)=explode(" ",$X,3);if($nb=="_id")$Mb["query"]["ids"]["values"][]=$X;elseif($nb.$X!=""){$Wh=array("term"=>array(($nb!=""?$nb:"_all")=>$X));if($qf=="=")$Mb["query"]["filtered"]["filter"]["and"][]=$Wh;else$Mb["query"]["filtered"]["query"]["bool"]["must"][]=$Wh;}}if($Mb["query"]&&!$Mb["query"]["filtered"]["query"]&&!$Mb["query"]["ids"])$Mb["query"]["filtered"]["query"]=array("match_all"=>array());$_h=microtime(true);$Zg=$this->_conn->query($G,$Mb);if($jg)echo$b->selectQuery("$G: ".print_r($Mb,true),$_h,!$Zg);if(!$Zg)return
false;$I=array();foreach($Zg['hits']['hits']as$Ad){$J=array();if($L==array("*"))$J["_id"]=$Ad["_id"];$p=$Ad['_source'];if($L!=array("*")){$p=array();foreach($L
as$y)$p[$y]=$Ad['fields'][$y];}foreach($p
as$y=>$X){if($Mb["fields"])$X=$X[0];$J[$y]=(is_array($X)?json_encode($X):$X);}$I[]=$J;}return
new
Min_Result($I);}function
update($U,$yg,$tg,$z=0,$M="\n"){$Tf=preg_split('~ *= *~',$tg);if(count($Tf)==2){$t=trim($Tf[1]);$G="$U/$t";return$this->_conn->query($G,$yg,'POST');}return
false;}function
insert($U,$yg){$t="";$G="$U/$t";$Jg=$this->_conn->query($G,$yg,'POST');$this->_conn->last_id=$Jg['_id'];return$Jg['created'];}function
delete($U,$tg,$z=0){$Ed=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Ed[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$db){$Tf=preg_split('~ *= *~',$db);if(count($Tf)==2)$Ed[]=trim($Tf[1]);}}$this->_conn->affected_rows=0;foreach($Ed
as$t){$G="{$U}/{$t}";$Jg=$this->_conn->query($G,'{}','DELETE');if(is_array($Jg)&&$Jg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();if($F!=""&&$g->connect($N,$V,""))return
lang(22);if($g->connect($N,$V,$F))return$g;return$g->error;}function
support($Qc){return
preg_match("~database|table|columns~",$Qc);}function
logged_user(){global$b;$Hb=$b->credentials();return$Hb[1];}function
get_databases(){global$g;$I=$g->rootQuery('_aliases');if($I){$I=array_keys($I);sort($I,SORT_STRING);}return$I;}function
collations(){return
array();}function
db_collation($l,$pb){}function
engines(){return
array();}function
count_tables($k){global$g;$I=array();$H=$g->query('_stats');if($H&&$H['indices']){$Ld=$H['indices'];foreach($Ld
as$Kd=>$Ah){$Jd=$Ah['total']['indexing'];$I[$Kd]=$Jd['index_total'];}}return$I;}function
tables_list(){global$g;$I=$g->query('_mapping');if($I)$I=array_fill_keys(array_keys($I[$g->_db]["mappings"]),'table');return$I;}function
table_status($C="",$Pc=false){global$g;$Zg=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$I=array();if($Zg){$T=$Zg["aggregations"]["count_by_type"]["buckets"];foreach($T
as$R){$I[$R["key"]]=array("Name"=>$R["key"],"Engine"=>"table","Rows"=>$R["doc_count"],);if($C!=""&&$C==$R["key"])return$I[$C];}}return$I;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($R){global$g;$H=$g->query("$R/_mapping");$I=array();if($H){$ze=$H[$R]['properties'];if(!$ze)$ze=$H[$g->_db]['mappings'][$R]['properties'];if($ze){foreach($ze
as$C=>$o){$I[$C]=array("field"=>$C,"full_type"=>$o["type"],"type"=>$o["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($o["properties"]){unset($I[$C]["privileges"]["insert"]);unset($I[$C]["privileges"]["update"]);}}}}return$I;}function
foreign_keys($R){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($o){}function
unconvert_field($o,$I){return$I;}function
fk_support($S){}function
found_rows($S,$Z){return
null;}function
create_database($l){global$g;return$g->rootQuery(urlencode($l),null,'PUT');}function
drop_databases($k){global$g;return$g->rootQuery(urlencode(implode(',',$k)),array(),'DELETE');}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){global$g;$pg=array();foreach($p
as$Nc){$Sc=trim($Nc[1][0]);$Tc=trim($Nc[1][1]?$Nc[1][1]:"text");$pg[$Sc]=array('type'=>$Tc);}if(!empty($pg))$pg=array('properties'=>$pg);return$g->query("_mapping/{$C}",$pg,'PUT');}function
drop_tables($T){global$g;$I=true;foreach($T
as$R)$I=$I&&$g->query(urlencode($R),array(),'DELETE');return$I;}function
last_id(){global$g;return$g->last_id;}$x="elastic";$sf=array("=","query");$ld=array();$rd=array();$nc=array(array("json"));$zi=array();$Dh=array();foreach(array(lang(27)=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),lang(28)=>array("date"=>10),lang(25)=>array("string"=>65535,"text"=>65535),lang(29)=>array("binary"=>255),)as$y=>$X){$zi+=$X;$Dh[$y]=array_keys($X);}}$fc=array("server"=>"MySQL")+$fc;if(!defined("DRIVER")){$eg=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($N="",$V="",$F="",$j=null,$ag=null,$qh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Bd,$ag)=explode(":",$N,2);$zh=$b->connectSsl();if($zh)$this->ssl_set($zh['key'],$zh['cert'],$zh['ca'],'','');$I=@$this->real_connect(($N!=""?$Bd:ini_get("mysqli.default_host")),($N.$V!=""?$V:ini_get("mysqli.default_user")),($N.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$j,(is_numeric($ag)?$ag:ini_get("mysqli.default_port")),(!is_numeric($ag)?$ag:$qh),($zh?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$I;}function
set_charset($cb){if(parent::set_charset($cb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $cb");}function
result($G,$o=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch_array();return$J[$o];}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(32,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($N!=""?$N:ini_get("mysql.default_host")),("$N$V"!=""?$V:ini_get("mysql.default_user")),("$N$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($cb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($cb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $cb");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($G,$_i=false){$H=@($_i?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$H){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($H===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$o=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
mysql_result($H->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;$this->num_rows=mysql_num_rows($H);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$I=mysql_fetch_field($this->_result,$this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=($I->blob?63:0);return$I;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($N,$V,$F){global$b;$vf=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$zh=$b->connectSsl();if($zh)$vf+=array(PDO::MYSQL_ATTR_SSL_KEY=>$zh['key'],PDO::MYSQL_ATTR_SSL_CERT=>$zh['cert'],PDO::MYSQL_ATTR_SSL_CA=>$zh['ca'],);$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F,$vf);return
true;}function
set_charset($cb){$this->query("SET NAMES $cb");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($G,$_i=false){$this->setAttribute(1000,!$_i);return
parent::query($G,$_i);}}}class
Min_Driver
extends
Min_SQL{function
insert($R,$O){return($O?parent::insert($R,$O):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,$K,$hg){$f=array_keys(reset($K));$fg="INSERT INTO ".table($R)." (".implode(", ",$f).") VALUES\n";$Ri=array();foreach($f
as$y)$Ri[$y]="$y = VALUES($y)";$Gh="\nON DUPLICATE KEY UPDATE ".implode(", ",$Ri);$Ri=array();$te=0;foreach($K
as$O){$Y="(".implode(", ",$O).")";if($Ri&&(strlen($fg)+$te+strlen($Y)+strlen($Gh)>1e6)){if(!queries($fg.implode(",\n",$Ri).$Gh))return
false;$Ri=array();$te=0;}$Ri[]=$Y;$te+=strlen($Y)+2;}return
queries($fg.implode(",\n",$Ri).$Gh);}function
slowQuery($G,$bi){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$bi FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($bi*1000).") */ $B[2]";}}function
convertSearch($u,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$H=$this->_conn->query("SHOW WARNINGS");if($H&&$H->num_rows){ob_start();select($H);return
ob_get_clean();}}function
tableHelp($C){$_e=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($_e?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($_e?"mysql$C-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$zi,$Dh;$g=new
Min_DB;$Hb=$b->credentials();if($g->connect($Hb[0],$Hb[1],$Hb[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Dh[lang(25)][]="json";$zi["json"]=4294967295;}return$g;}$I=$g->error;if(function_exists('iconv')&&!is_utf8($I)&&strlen($Vg=iconv("windows-1250","utf-8",$I))>strlen($I))$I=$Vg;return$I;}function
get_databases($bd){$I=get_session("dbs");if($I===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$I=($bd?slow_query($G):get_vals($G));restart_session();set_session("dbs",$I);stop_session();}return$I;}function
limit($G,$Z,$z,$D=0,$M=" "){return" $G$Z".($z!==null?$M."LIMIT $z".($D?" OFFSET $D":""):"");}function
limit1($R,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($l,$pb){global$g;$I=null;$i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$i,$B))$I=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$i,$B))$I=$pb[$B[1]][-1];return$I;}function
engines(){$I=array();foreach(get_rows("SHOW ENGINES")as$J){if(preg_match("~YES|DEFAULT~",$J["Support"]))$I[]=$J["Engine"];}return$I;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$I=array();foreach($k
as$l)$I[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$I;}function
table_status($C="",$Pc=false){$I=array();foreach(get_rows($Pc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$J){if($J["Engine"]=="InnoDB")$J["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$J["Comment"]);if(!isset($J["Engine"]))$J["Comment"]="";if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($S){return$S["Engine"]===null;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"])||(preg_match('~NDB~i',$S["Engine"])&&min_version(5.6));}function
fields($R){$I=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($R))as$J){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$J["Type"],$B);$I[$J["Field"]]=array("field"=>$J["Field"],"full_type"=>$J["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($J["Default"]!=""||preg_match("~char|set~",$B[1])?$J["Default"]:null),"null"=>($J["Null"]=="YES"),"auto_increment"=>($J["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$J["Extra"],$B)?$B[1]:""),"collation"=>$J["Collation"],"privileges"=>array_flip(preg_split('~, *~',$J["Privileges"])),"comment"=>$J["Comment"],"primary"=>($J["Key"]=="PRI"),);}return$I;}function
indexes($R,$h=null){$I=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$h)as$J){$C=$J["Key_name"];$I[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($J["Index_type"]=="FULLTEXT"?"FULLTEXT":($J["Non_unique"]?($J["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$I[$C]["columns"][]=$J["Column_name"];$I[$C]["lengths"][]=($J["Index_type"]=="SPATIAL"?null:$J["Sub_part"]);$I[$C]["descs"][]=null;}return$I;}function
foreign_keys($R){global$g,$nf;static$Xf='`(?:[^`]|``)+`';$I=array();$Fb=$g->result("SHOW CREATE TABLE ".table($R),1);if($Fb){preg_match_all("~CONSTRAINT ($Xf) FOREIGN KEY ?\\(((?:$Xf,? ?)+)\\) REFERENCES ($Xf)(?:\\.($Xf))? \\(((?:$Xf,? ?)+)\\)(?: ON DELETE ($nf))?(?: ON UPDATE ($nf))?~",$Fb,$Ce,PREG_SET_ORDER);foreach($Ce
as$B){preg_match_all("~$Xf~",$B[2],$sh);preg_match_all("~$Xf~",$B[5],$Th);$I[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$sh[0]),"target"=>array_map('idf_unescape',$Th[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$I=array();foreach(get_rows("SHOW COLLATION")as$J){if($J["Default"])$I[$J["Charset"]][-1]=$J["Collation"];else$I[$J["Charset"]][]=$J["Collation"];}ksort($I);foreach($I
as$y=>$X)asort($I[$y]);return$I;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$I=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$I;}function
rename_database($C,$d){$I=false;if(create_database($C,$d)){$Hg=array();foreach(tables_list()as$R=>$U)$Hg[]=table($R)." TO ".idf_escape($C).".".table($R);$I=(!$Hg||queries("RENAME TABLE ".implode(", ",$Hg)));if($I)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$I;}function
auto_increment(){$Na=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Na="";break;}if($v["type"]=="PRIMARY")$Na=" UNIQUE";}}return" AUTO_INCREMENT$Na";}function
alter_table($R,$C,$p,$dd,$ub,$vc,$d,$Ma,$Rf){$c=array();foreach($p
as$o)$c[]=($o[1]?($R!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($R!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$dd);$P=($ub!==null?" COMMENT=".q($ub):"").($vc?" ENGINE=".q($vc):"").($d?" COLLATE ".q($d):"").($Ma!=""?" AUTO_INCREMENT=$Ma":"");if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$P$Rf");if($R!=$C)$c[]="RENAME TO ".table($C);if($P)$c[]=ltrim($P);return($c||$Rf?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$Rf):true);}function
alter_indexes($R,$c){foreach($c
as$y=>$X)$c[$y]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$c));}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Wi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Wi)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Wi,$Th){$Hg=array();foreach(array_merge($T,$Wi)as$R)$Hg[]=table($R)." TO ".idf_escape($Th).".".table($R);return
queries("RENAME TABLE ".implode(", ",$Hg));}function
copy_tables($T,$Wi,$Th){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$C=($Th==DB?table("copy_$R"):idf_escape($Th).".".table($R));if(!queries("\nDROP TABLE IF EXISTS $C")||!queries("CREATE TABLE $C LIKE ".table($R))||!queries("INSERT INTO $C SELECT * FROM ".table($R)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$J){$ti=$J["Trigger"];if(!queries("CREATE TRIGGER ".($Th==DB?idf_escape("copy_$ti"):idf_escape($Th).".".idf_escape($ti))." $J[Timing] $J[Event] ON $C FOR EACH ROW\n$J[Statement];"))return
false;}}foreach($Wi
as$R){$C=($Th==DB?table("copy_$R"):idf_escape($Th).".".table($R));$Vi=view($R);if(!queries("DROP VIEW IF EXISTS $C")||!queries("CREATE VIEW $C AS $Vi[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$K=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($K);}function
triggers($R){$I=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$J)$I[$J["Trigger"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$U){global$g,$xc,$Qd,$zi;$Da=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$th="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$yi="((".implode("|",array_merge(array_keys($zi),$Da)).")\\b(?:\\s*\\(((?:[^'\")]|$xc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Xf="$th*(".($U=="FUNCTION"?"":$Qd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$yi";$i=$g->result("SHOW CREATE $U ".idf_escape($C),2);preg_match("~\\(((?:$Xf\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$yi\\s+":"")."(.*)~is",$i,$B);$p=array();preg_match_all("~$Xf\\s*,?~is",$B[1],$Ce,PREG_SET_ORDER);foreach($Ce
as$Kf){$C=str_replace("``","`",$Kf[2]).$Kf[3];$p[]=array("field"=>$C,"type"=>strtolower($Kf[5]),"length"=>preg_replace_callback("~$xc~s",'normalize_enum',$Kf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Kf[8] $Kf[7]"))),"null"=>1,"full_type"=>$Kf[4],"inout"=>strtoupper($Kf[1]),"collation"=>strtolower($Kf[9]),);}if($U!="FUNCTION")return
array("fields"=>$p,"definition"=>$B[11]);return
array("fields"=>$p,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$J){return
idf_escape($C);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$G){return$g->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$G);}function
found_rows($S,$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
create_sql($R,$Ma,$Eh){global$g;$I=$g->result("SHOW CREATE TABLE ".table($R),1);if(!$Ma)$I=preg_replace('~ AUTO_INCREMENT=\d+~','',$I);return$I;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($R){$I="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$J)$I.="\nCREATE TRIGGER ".idf_escape($J["Trigger"])." $J[Timing] $J[Event] ON ".table($J["Table"])." FOR EACH ROW\n$J[Statement];;\n";return$I;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$I){if(preg_match("~binary~",$o["type"]))$I="UNHEX($I)";if($o["type"]=="bit")$I="CONV($I, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))$I=(min_version(8)?"ST_":"")."GeomFromText($I)";return$I;}function
support($Qc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))."~",$Qc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}$x="sql";$zi=array();$Dh=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(25)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(33)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$y=>$X){$zi+=$X;$Dh[$y]=array_keys($X);}$Fi=array("unsigned","zerofill","unsigned zerofill");$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$ld=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$rd=array("avg","count","count distinct","group_concat","max","min","sum");$nc=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\1',$_SERVER["REQUEST_URI"]).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.6.3";class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($i=false){return
password_file($i);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($N){return
h($N);}function
database(){return
DB;}function
databases($bd=true){return
get_databases($bd);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$I=array();$Vc="adminer.css";if(file_exists($Vc))$I[]=$Vc;return$I;}function
loginForm(){global$fc;echo"<table cellspacing='0'>\n",$this->loginFormField('driver','<tr><th>'.lang(34).'<td>',html_select("auth[driver]",$fc,DRIVER)."\n"),$this->loginFormField('server','<tr><th>'.lang(35).'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.lang(36).'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.lang(37).'<td>','<input type="password" name="auth[password]">'."\n"),$this->loginFormField('db','<tr><th>'.lang(38).'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".lang(39)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(40))."\n";}function
loginFormField($C,$yd,$Y){return$yd.$Y;}function
login($xe,$F){return
true;}function
tableName($Kh){return
h($Kh["Name"]);}function
fieldName($o,$xf=0){return'<span title="'.h($o["full_type"]).'">'.h($o["field"]).'</span>';}function
selectLinks($Kh,$O=""){global$x,$m;echo'<p class="links">';$we=array("select"=>lang(41));if(support("table")||support("indexes"))$we["table"]=lang(42);if(support("table")){if(is_view($Kh))$we["view"]=lang(43);else$we["create"]=lang(44);}if($O!==null)$we["edit"]=lang(45);$C=$Kh["Name"];foreach($we
as$y=>$X)echo" <a href='".h(ME)."$y=".urlencode($C).($y=="edit"?$O:"")."'".bold(isset($_GET[$y])).">$X</a>";echo
doc_link(array($x=>$m->tableHelp($C)),"?"),"\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$Jh){return
array();}function
backwardKeysPrint($Pa,$J){}function
selectQuery($G,$_h,$Oc=false){global$x,$m;$I="</p>\n";if(!$Oc&&($Zi=$m->warnings())){$t="warnings";$I=", <a href='#$t'>".lang(46)."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."$I<div id='$t' class='hidden'>\n$Zi</div>\n";}return"<p><code class='jush-$x'>".h(str_replace("\n"," ",$G))."</code> <span class='time'>(".format_time($_h).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($G)."'>".lang(10)."</a>":"").$I;}function
sqlCommandQuery($G){return
shorten_utf8(trim($G),1000);}function
rowDescription($R){return"";}function
rowDescriptions($K,$ed){return$K;}function
selectLink($X,$o){}function
selectVal($X,$_,$o,$Ef){$I=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$o["type"])&&!preg_match("~var~",$o["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$o["type"])&&!is_utf8($X))$I="<i>".lang(47,strlen($Ef))."</i>";if(preg_match('~json~',$o["type"]))$I="<code class='jush-js'>$I</code>";return($_?"<a href='".h($_)."'".(is_url($_)?target_blank():"").">$I</a>":$I);}function
editVal($X,$o){return$X;}function
tableStructurePrint($p){echo"<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".lang(48)."<td>".lang(49).(support("comment")?"<td>".lang(50):"")."</thead>\n";foreach($p
as$o){echo"<tr".odd()."><th>".h($o["field"]),"<td><span title='".h($o["collation"])."'>".h($o["full_type"])."</span>",($o["null"]?" <i>NULL</i>":""),($o["auto_increment"]?" <i>".lang(51)."</i>":""),(isset($o["default"])?" <span title='".lang(52)."'>[<b>".h($o["default"])."</b>]</span>":""),(support("comment")?"<td>".h($o["comment"]):""),"\n";}echo"</table>\n";}function
tableIndexesPrint($w){echo"<table cellspacing='0'>\n";foreach($w
as$C=>$v){ksort($v["columns"]);$jg=array();foreach($v["columns"]as$y=>$X)$jg[]="<i>".h($X)."</i>".($v["lengths"][$y]?"(".$v["lengths"][$y].")":"").($v["descs"][$y]?" DESC":"");echo"<tr title='".h($C)."'><th>$v[type]<td>".implode(", ",$jg)."\n";}echo"</table>\n";}function
selectColumnsPrint($L,$f){global$ld,$rd;print_fieldset("select",lang(53),$L);$s=0;$L[""]=array();foreach($L
as$y=>$X){$X=$_GET["columns"][$y];$e=select_input(" name='columns[$s][col]'",$f,$X["col"],($y!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($ld||$rd?"<select name='columns[$s][fun]'>".optionlist(array(-1=>"")+array_filter(array(lang(54)=>$ld,lang(55)=>$rd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($y!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($e)":$e)."</div>\n";$s++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$f,$w){print_fieldset("search",lang(56),$Z);foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$v["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$s]' value='".h($_GET["fulltext"][$s])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$s]",1,isset($_GET["boolean"][$s]),"BOOL"),"</div>\n";}}$bb="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$s=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$s][col]'",$f,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".lang(57).")"),html_select("where[$s][op]",$this->operators,$X["op"],$bb),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $bb }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($xf,$f,$w){print_fieldset("sort",lang(58),$xf);$s=0;foreach((array)$_GET["order"]as$y=>$X){if($X!=""){echo"<div>".select_input(" name='order[$s]'",$f,$X,"selectFieldChange"),checkbox("desc[$s]",1,isset($_GET["desc"][$y]),lang(59))."</div>\n";$s++;}}echo"<div>".select_input(" name='order[$s]'",$f,"","selectAddRow"),checkbox("desc[$s]",1,false,lang(59))."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($z){echo"<fieldset><legend>".lang(60)."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($z)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($Zh){if($Zh!==null){echo"<fieldset><legend>".lang(61)."</legend><div>","<input type='number' name='text_length' class='size' value='".h($Zh)."'>","</div></fieldset>\n";}}function
selectActionPrint($w){echo"<fieldset><legend>".lang(62)."</legend><div>","<input type='submit' value='".lang(53)."'>"," <span id='noindex' title='".lang(63)."'></span>","<script".nonce().">\n","var indexColumns = ";$f=array();foreach($w
as$v){$Lb=reset($v["columns"]);if($v["type"]!="FULLTEXT"&&$Lb)$f[$Lb]=1;}$f[""]=1;foreach($f
as$y=>$X)json_row($y);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($sc,$f){}function
selectColumnsProcess($f,$w){global$ld,$rd;$L=array();$od=array();foreach((array)$_GET["columns"]as$y=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$ld)||in_array($X["fun"],$rd)))){$L[$y]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$rd))$od[]=$L[$y];}}return
array($L,$od);}function
selectSearchProcess($p,$w){global$g,$m;$I=array();foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"&&$_GET["fulltext"][$s]!="")$I[]="MATCH (".implode(", ",array_map('idf_escape',$v["columns"])).") AGAINST (".q($_GET["fulltext"][$s]).(isset($_GET["boolean"][$s])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$y=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$fg="";$xb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Gd=process_length($X["val"]);$xb.=" ".($Gd!=""?$Gd:"(NULL)");}elseif($X["op"]=="SQL")$xb=" $X[val]";elseif($X["op"]=="LIKE %%")$xb=" LIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$xb=" ILIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$fg="$X[op](".q($X["val"]).", ";$xb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$xb.=" ".$this->processInput($p[$X["col"]],$X["val"]);if($X["col"]!="")$I[]=$fg.$m->convertSearch(idf_escape($X["col"]),$X,$p[$X["col"]]).$xb;else{$rb=array();foreach($p
as$C=>$o){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$o["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$o["type"])))$rb[]=$fg.$m->convertSearch(idf_escape($C),$X,$o).$xb;}$I[]=($rb?"(".implode(" OR ",$rb).")":"1 = 0");}}}return$I;}function
selectOrderProcess($p,$w){$I=array();foreach((array)$_GET["order"]as$y=>$X){if($X!="")$I[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$y])?" DESC":"");}return$I;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$ed){return
false;}function
selectQueryBuild($L,$Z,$od,$xf,$z,$E){return"";}function
messageQuery($G,$ai,$Oc=false){global$x,$m;restart_session();$zd=&get_session("queries");if(!$zd[$_GET["db"]])$zd[$_GET["db"]]=array();if(strlen($G)>1e6)$G=preg_replace('~[\x80-\xFF]+$~','',substr($G,0,1e6))."\n...";$zd[$_GET["db"]][]=array($G,time(),$ai);$xh="sql-".count($zd[$_GET["db"]]);$I="<a href='#$xh' class='toggle'>".lang(64)."</a>\n";if(!$Oc&&($Zi=$m->warnings())){$t="warnings-".count($zd[$_GET["db"]]);$I="<a href='#$t' class='toggle'>".lang(46)."</a>, $I<div id='$t' class='hidden'>\n$Zi</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $I<div id='$xh' class='hidden'><pre><code class='jush-$x'>".shorten_utf8($G,1000)."</code></pre>".($ai?" <span class='time'>($ai)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($zd[$_GET["db"]])-1)).'">'.lang(10).'</a>':'').'</div>';}function
editFunctions($o){global$nc;$I=($o["null"]?"NULL/":"");foreach($nc
as$y=>$ld){if(!$y||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($ld
as$Xf=>$X){if(!$Xf||preg_match("~$Xf~",$o["type"]))$I.="/$X";}if($y&&!preg_match('~set|blob|bytea|raw|file~',$o["type"]))$I.="/SQL";}}if($o["auto_increment"]&&!isset($_GET["select"])&&!where($_GET))$I=lang(51);return
explode("/",$I);}function
editInput($R,$o,$Ka,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ka value='-1' checked><i>".lang(8)."</i></label> ":"").($o["null"]?"<label><input type='radio'$Ka value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ka,$o,$Y,0);return"";}function
editHint($R,$o,$Y){return"";}function
processInput($o,$Y,$r=""){if($r=="SQL")return$Y;$C=$o["field"];$I=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$r))$I="$r()";elseif(preg_match('~^current_(date|timestamp)$~',$r))$I=$r;elseif(preg_match('~^([+-]|\|\|)$~',$r))$I=idf_escape($C)." $r $I";elseif(preg_match('~^[+-] interval$~',$r))$I=idf_escape($C)." $r ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$I);elseif(preg_match('~^(addtime|subtime|concat)$~',$r))$I="$r(".idf_escape($C).", $I)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$r))$I="$r($I)";return
unconvert_field($o,$I);}function
dumpOutput(){$I=array('text'=>lang(65),'file'=>lang(66));if(function_exists('gzencode'))$I['gz']='gzip';return$I;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($R,$Eh,$Zd=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Eh)dump_csv(array_keys(fields($R)));}else{if($Zd==2){$p=array();foreach(fields($R)as$C=>$o)$p[]=idf_escape($C)." $o[full_type]";$i="CREATE TABLE ".table($R)." (".implode(", ",$p).")";}else$i=create_sql($R,$_POST["auto_increment"],$Eh);set_utf8mb4($i);if($Eh&&$i){if($Eh=="DROP+CREATE"||$Zd==1)echo"DROP ".($Zd==2?"VIEW":"TABLE")." IF EXISTS ".table($R).";\n";if($Zd==1)$i=remove_definer($i);echo"$i;\n\n";}}}function
dumpData($R,$Eh,$G){global$g,$x;$Ee=($x=="sqlite"?0:1048576);if($Eh){if($_POST["format"]=="sql"){if($Eh=="TRUNCATE+INSERT")echo
truncate_sql($R).";\n";$p=fields($R);}$H=$g->query($G,1);if($H){$Sd="";$Ya="";$ge=array();$Gh="";$Rc=($R!=''?'fetch_assoc':'fetch_row');while($J=$H->$Rc()){if(!$ge){$Ri=array();foreach($J
as$X){$o=$H->fetch_field();$ge[]=$o->name;$y=idf_escape($o->name);$Ri[]="$y = VALUES($y)";}$Gh=($Eh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Ri):"").";\n";}if($_POST["format"]!="sql"){if($Eh=="table"){dump_csv($ge);$Eh="INSERT";}dump_csv($J);}else{if(!$Sd)$Sd="INSERT INTO ".table($R)." (".implode(", ",array_map('idf_escape',$ge)).") VALUES";foreach($J
as$y=>$X){$o=$p[$y];$J[$y]=($X!==null?unconvert_field($o,preg_match(number_type(),$o["type"])&&$X!=''?$X:q(($X===false?0:$X))):"NULL");}$Vg=($Ee?"\n":" ")."(".implode(",\t",$J).")";if(!$Ya)$Ya=$Sd.$Vg;elseif(strlen($Ya)+4+strlen($Vg)+strlen($Gh)<$Ee)$Ya.=",$Vg";else{echo$Ya.$Gh;$Ya=$Sd.$Vg;}}}if($Ya)echo$Ya.$Gh;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$g->error)."\n";}}function
dumpFilename($Dd){return
friendly_url($Dd!=""?$Dd:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Dd,$Te=false){$Hf=$_POST["output"];$Jc=(preg_match('~sql~',$_POST["format"])?"sql":($Te?"tar":"csv"));header("Content-Type: ".($Hf=="gz"?"application/x-gzip":($Jc=="tar"?"application/x-tar":($Jc=="sql"||$Hf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Hf=="gz")ob_start('ob_gzencode',1e6);return$Jc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.lang(67)."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?lang(68):lang(69))."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.lang(70)."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".lang(71)."</a>\n":"");return
true;}function
navigation($Se){global$ia,$x,$fc,$g;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Se=="auth"){$Xc=true;foreach((array)$_SESSION["pwds"]as$Ti=>$jh){foreach($jh
as$N=>$Oi){foreach($Oi
as$V=>$F){if($F!==null){if($Xc){echo"<p id='logins'>".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$Xc=false;}$Rb=$_SESSION["db"][$Ti][$N][$V];foreach(($Rb?array_keys($Rb):array(""))as$l)echo"<a href='".h(auth_url($Ti,$N,$V,$l))."'>($fc[$Ti]) ".h($V.($N!=""?"@".$this->serverName($N):"").($l!=""?" - $l":""))."</a><br>\n";}}}}}else{if($_GET["ns"]!==""&&!$Se&&DB!=""){$g->select_db(DB);$T=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.6.3");if(support("sql")){echo'<script',nonce(),'>
';if($T){$we=array();foreach($T
as$R=>$U)$we[]=preg_quote($R,'/');echo"var jushLinks = { $x: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$we).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$x;\n";}$ih=$g->server_info;echo'bodyLoad(\'',(is_object($g)?preg_replace('~^(\d\.?\d).*~s','\1',$ih):""),'\'',(preg_match('~MariaDB~',$ih)?", true":""),');
</script>
';}$this->databasesPrint($Se);if(DB==""||!$Se){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".lang(64)."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".lang(72)."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".lang(73)."</a>\n";}if($_GET["ns"]!==""&&!$Se&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".lang(74)."</a>\n";if(!$T)echo"<p class='message'>".lang(9)."\n";else$this->tablesPrint($T);}}}function
databasesPrint($Se){global$b,$g;$k=$this->databases();if($k&&!in_array(DB,$k))array_unshift($k,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Pb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".lang(75)."'>".lang(76)."</span>: ".($k?"<select name='db'>".optionlist(array(""=>"")+$k,DB)."</select>$Pb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".lang(20)."'".($k?" class='hidden'":"").">\n";if($Se!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".lang(77).": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Pb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($T){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$R=>$P){$C=$this->tableName($P);if($C!=""){echo'<li><a href="'.h(ME).'select='.urlencode($R).'"'.bold($_GET["select"]==$R||$_GET["edit"]==$R,"select").">".lang(78)."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($R).'"'.bold(in_array($R,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($P)?"view":"structure"))." title='".lang(42)."'>$C</a>":"<span>$C</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);if($b->operators===null)$b->operators=$sf;function
page_header($di,$n="",$Xa=array(),$ei=""){global$ca,$ia,$b,$fc,$x;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$fi=$di.($ei!=""?": $ei":"");$gi=strip_tags($fi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ca,'" dir="',lang(79),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$gi,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.6.3"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.6.3");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
';foreach($b->css()as$Jb){echo'<link rel="stylesheet" type="text/css" href="',h($Jb),'">
';}}echo'
<body class="',lang(79),' nojs">
';$Vc=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($Vc)&&filemtime($Vc)+86400>time()){$Ui=unserialize(file_get_contents($Vc));$qg="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Ui["version"],base64_decode($Ui["signature"]),$qg)==1)$_COOKIE["adminer_version"]=$Ui["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(80)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$x,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Xa!==null){$_=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($_?$_:".").'">'.$fc[DRIVER].'</a> &raquo; ';$_=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$N=$b->serverName(SERVER);$N=($N!=""?$N:lang(35));if($Xa===false)echo"$N\n";else{echo"<a href='".($_?h($_):".")."' accesskey='1' title='Alt+Shift+1'>$N</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Xa)))echo'<a href="'.h($_."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Xa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Xa
as$y=>$X){$Xb=(is_array($X)?$X[1]:h($X));if($Xb!="")echo"<a href='".h(ME."$y=").urlencode(is_array($X)?$X[0]:$X)."'>$Xb</a> &raquo; ";}}echo"$di\n";}}echo"<h2>$fi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Ib){$xd=array();foreach($Ib
as$y=>$X)$xd[]="$y $X";header("Content-Security-Policy: ".implode("; ",$xd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$cf;if(!$cf)$cf=base64_encode(rand_string());return$cf;}function
page_messages($n){$Hi=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Oe=$_SESSION["messages"][$Hi];if($Oe){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Oe)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Hi]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Se=""){global$b,$ki;echo'</div>

';switch_lang();if($Se!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="',lang(81),'" id="logout">
<input type="hidden" name="token" value="',$ki,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Se);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Ve){while($Ve>=2147483648)$Ve-=4294967296;while($Ve<=-2147483649)$Ve+=4294967296;return(int)$Ve;}function
long2str($W,$Yi){$Vg='';foreach($W
as$X)$Vg.=pack('V',$X);if($Yi)return
substr($Vg,0,end($W));return$Vg;}function
str2long($Vg,$Yi){$W=array_values(unpack('V*',str_pad($Vg,4*ceil(strlen($Vg)/4),"\0")));if($Yi)$W[]=strlen($Vg);return$W;}function
xxtea_mx($lj,$kj,$Hh,$ce){return
int32((($lj>>5&0x7FFFFFF)^$kj<<2)+(($kj>>3&0x1FFFFFFF)^$lj<<4))^int32(($Hh^$kj)+($ce^$lj));}function
encrypt_string($Ch,$y){if($Ch=="")return"";$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Ch,true);$Ve=count($W)-1;$lj=$W[$Ve];$kj=$W[0];$rg=floor(6+52/($Ve+1));$Hh=0;while($rg-->0){$Hh=int32($Hh+0x9E3779B9);$mc=$Hh>>2&3;for($If=0;$If<$Ve;$If++){$kj=$W[$If+1];$Ue=xxtea_mx($lj,$kj,$Hh,$y[$If&3^$mc]);$lj=int32($W[$If]+$Ue);$W[$If]=$lj;}$kj=$W[0];$Ue=xxtea_mx($lj,$kj,$Hh,$y[$If&3^$mc]);$lj=int32($W[$Ve]+$Ue);$W[$Ve]=$lj;}return
long2str($W,false);}function
decrypt_string($Ch,$y){if($Ch=="")return"";if(!$y)return
false;$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Ch,false);$Ve=count($W)-1;$lj=$W[$Ve];$kj=$W[0];$rg=floor(6+52/($Ve+1));$Hh=int32($rg*0x9E3779B9);while($Hh){$mc=$Hh>>2&3;for($If=$Ve;$If>0;$If--){$lj=$W[$If-1];$Ue=xxtea_mx($lj,$kj,$Hh,$y[$If&3^$mc]);$kj=int32($W[$If]-$Ue);$W[$If]=$kj;}$lj=$W[$Ve];$Ue=xxtea_mx($lj,$kj,$Hh,$y[$If&3^$mc]);$kj=int32($W[0]-$Ue);$W[0]=$kj;$Hh=int32($Hh-0x9E3779B9);}return
long2str($W,true);}$g='';$wd=$_SESSION["token"];if(!$wd)$_SESSION["token"]=rand(1,1e6);$ki=get_token();$Yf=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($y)=explode(":",$X);$Yf[$y]=$X;}}function
add_invalid_login(){global$b;$jd=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$jd)return;$Vd=unserialize(stream_get_contents($jd));$ai=time();if($Vd){foreach($Vd
as$Wd=>$X){if($X[0]<$ai)unset($Vd[$Wd]);}}$Ud=&$Vd[$b->bruteForceKey()];if(!$Ud)$Ud=array($ai+30*60,0);$Ud[1]++;file_write_unlock($jd,serialize($Vd));}function
check_invalid_login(){global$b;$Vd=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$Ud=$Vd[$b->bruteForceKey()];$bf=($Ud[1]>29?$Ud[0]-time():0);if($bf>0)auth_error(lang(82,ceil($bf/60)));}$La=$_POST["auth"];if($La){session_regenerate_id();$Ti=$La["driver"];$N=$La["server"];$V=$La["username"];$F=(string)$La["password"];$l=$La["db"];set_password($Ti,$N,$V,$F);$_SESSION["db"][$Ti][$N][$V][$l]=true;if($La["permanent"]){$y=base64_encode($Ti)."-".base64_encode($N)."-".base64_encode($V)."-".base64_encode($l);$kg=$b->permanentLogin(true);$Yf[$y]="$y:".base64_encode($kg?encrypt_string($F,$kg):"");cookie("adminer_permanent",implode(" ",$Yf));}if(count($_POST)==1||DRIVER!=$Ti||SERVER!=$N||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($Ti,$N,$V,$l));}elseif($_POST["logout"]){if($wd&&!verify_token()){page_header(lang(81),lang(83));page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$y)set_session($y,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(84).' '.lang(85,'https://sourceforge.net/donate/index.php?group_id=264133'));}}elseif($Yf&&!$_SESSION["pwds"]){session_regenerate_id();$kg=$b->permanentLogin();foreach($Yf
as$y=>$X){list(,$jb)=explode(":",$X);list($Ti,$N,$V,$l)=array_map('base64_decode',explode("-",$y));set_password($Ti,$N,$V,decrypt_string(base64_decode($jb),$kg));$_SESSION["db"][$Ti][$N][$V][$l]=true;}}function
unset_permanent(){global$Yf;foreach($Yf
as$y=>$X){list($Ti,$N,$V,$l)=array_map('base64_decode',explode("-",$y));if($Ti==DRIVER&&$N==SERVER&&$V==$_GET["username"]&&$l==DB)unset($Yf[$y]);}cookie("adminer_permanent",implode(" ",$Yf));}function
auth_error($n){global$b,$wd;$kh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$kh]||$_GET[$kh])&&!$wd)$n=lang(86);else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$n.='<br>'.lang(87,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$kh]&&$_GET[$kh]&&ini_bool("session.use_only_cookies"))$n=lang(88);$Lf=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Lf["lifetime"]);page_header(lang(39),$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(89)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(90),lang(91,implode(", ",$eg)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])){list($Bd,$ag)=explode(":",SERVER,2);if(is_numeric($ag)&&$ag<1024)auth_error(lang(92));check_invalid_login();$g=connect();$m=new
Min_Driver($g);}$xe=null;if(!is_object($g)||($xe=$b->login($_GET["username"],get_password()))!==true)auth_error((is_string($g)?h($g):(is_string($xe)?$xe:lang(93))));if($La&&$_POST["token"])$_POST["token"]=$ki;$n='';if($_POST){if(!verify_token()){$Pd="max_input_vars";$Ie=ini_get($Pd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$y){$X=ini_get($y);if($X&&(!$Ie||$X<$Ie)){$Pd=$y;$Ie=$X;}}}$n=(!$_POST["token"]&&$Ie?lang(94,"'$Pd'"):lang(83).' '.lang(95));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=lang(96,"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.lang(97);}function
select($H,$h=null,$_f=array(),$z=0){global$x;$we=array();$w=array();$f=array();$Ua=array();$zi=array();$I=array();odd('');for($s=0;(!$z||$s<$z)&&($J=$H->fetch_row());$s++){if(!$s){echo"<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($be=0;$be<count($J);$be++){$o=$H->fetch_field();$C=$o->name;$zf=$o->orgtable;$yf=$o->orgname;$I[$o->table]=$zf;if($_f&&$x=="sql")$we[$be]=($C=="table"?"table=":($C=="possible_keys"?"indexes=":null));elseif($zf!=""){if(!isset($w[$zf])){$w[$zf]=array();foreach(indexes($zf,$h)as$v){if($v["type"]=="PRIMARY"){$w[$zf]=array_flip($v["columns"]);break;}}$f[$zf]=$w[$zf];}if(isset($f[$zf][$yf])){unset($f[$zf][$yf]);$w[$zf][$yf]=$be;$we[$be]=$zf;}}if($o->charsetnr==63)$Ua[$be]=true;$zi[$be]=$o->type;echo"<th".($zf!=""||$o->name!=$yf?" title='".h(($zf!=""?"$zf.":"").$yf)."'":"").">".h($C).($_f?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($C),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($J
as$y=>$X){if($X===null)$X="<i>NULL</i>";elseif($Ua[$y]&&!is_utf8($X))$X="<i>".lang(47,strlen($X))."</i>";else{$X=h($X);if($zi[$y]==254)$X="<code>$X</code>";}if(isset($we[$y])&&!$f[$we[$y]]){if($_f&&$x=="sql"){$R=$J[array_search("table=",$we)];$_=$we[$y].urlencode($_f[$R]!=""?$_f[$R]:$R);}else{$_="edit=".urlencode($we[$y]);foreach($w[$we[$y]]as$nb=>$be)$_.="&where".urlencode("[".bracket_escape($nb)."]")."=".urlencode($J[$be]);}$X="<a href='".h(ME.$_)."'>$X</a>";}echo"<td>$X";}}echo($s?"</table>":"<p class='message'>".lang(12))."\n";return$I;}function
referencable_primary($eh){$I=array();foreach(table_status('',true)as$Lh=>$R){if($Lh!=$eh&&fk_support($R)){foreach(fields($Lh)as$o){if($o["primary"]){if($I[$Lh]){unset($I[$Lh]);break;}$I[$Lh]=$o;}}}}return$I;}function
textarea($C,$Y,$K=10,$rb=80){global$x;echo"<textarea name='$C' rows='$K' cols='$rb' class='sqlarea jush-$x' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($y,$o,$pb,$fd=array(),$Mc=array()){global$Dh,$zi,$Fi,$nf;$U=$o["type"];echo'<td><select name="',h($y),'[type]" class="type" aria-labelledby="label-type">';if($U&&!isset($zi[$U])&&!isset($fd[$U])&&!in_array($U,$Mc))$Mc[]=$U;if($fd)$Dh[lang(98)]=$fd;echo
optionlist(array_merge($Mc,$Dh),$U),'</select>
',on_help("getTarget(event).value",1),script("mixin(qsl('select'), {onfocus: function () { lastType = selectValue(this); }, onchange: editingTypeChange});",""),'<td><input name="',h($y),'[length]" value="',h($o["length"]),'" size="3"',(!$o["length"]&&preg_match('~var(char|binary)$~',$U)?" class='required'":"");echo' aria-labelledby="label-length">',script("mixin(qsl('input'), {onfocus: editingLengthFocus, oninput: editingLengthChange});",""),'<td class="options">',"<select name='".h($y)."[collation]'".(preg_match('~(char|text|enum|set)$~',$U)?"":" class='hidden'").'><option value="">('.lang(99).')'.optionlist($pb,$o["collation"]).'</select>',($Fi?"<select name='".h($y)."[unsigned]'".(!$U||preg_match(number_type(),$U)?"":" class='hidden'").'><option>'.optionlist($Fi,$o["unsigned"]).'</select>':''),(isset($o['on_update'])?"<select name='".h($y)."[on_update]'".(preg_match('~timestamp|datetime~',$U)?"":" class='hidden'").'>'.optionlist(array(""=>"(".lang(100).")","CURRENT_TIMESTAMP"),$o["on_update"]).'</select>':''),($fd?"<select name='".h($y)."[on_delete]'".(preg_match("~`~",$U)?"":" class='hidden'")."><option value=''>(".lang(101).")".optionlist(explode("|",$nf),$o["on_delete"])."</select> ":" ");}function
process_length($te){global$xc;return(preg_match("~^\\s*\\(?\\s*$xc(?:\\s*,\\s*$xc)*+\\s*\\)?\\s*\$~",$te)&&preg_match_all("~$xc~",$te,$Ce)?"(".implode(",",$Ce[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$te)));}function
process_type($o,$ob="COLLATE"){global$Fi;return" $o[type]".process_length($o["length"]).(preg_match(number_type(),$o["type"])&&in_array($o["unsigned"],$Fi)?" $o[unsigned]":"").(preg_match('~char|text|enum|set~',$o["type"])&&$o["collation"]?" $ob ".q($o["collation"]):"");}function
process_field($o,$xi){return
array(idf_escape(trim($o["field"])),process_type($xi),($o["null"]?" NULL":" NOT NULL"),default_value($o),(preg_match('~timestamp|datetime~',$o["type"])&&$o["on_update"]?" ON UPDATE $o[on_update]":""),(support("comment")&&$o["comment"]!=""?" COMMENT ".q($o["comment"]):""),($o["auto_increment"]?auto_increment():null),);}function
default_value($o){$Tb=$o["default"];return($Tb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$o["type"])||preg_match('~^(?![a-z])~i',$Tb)?q($Tb):$Tb));}function
type_class($U){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$y=>$X){if(preg_match("~$y|$X~",$U))return" class='$y'";}}function
edit_fields($p,$pb,$U="TABLE",$fd=array(),$vb=false){global$Qd;$p=array_values($p);echo'<thead><tr>
';if($U=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($U=="TABLE"?lang(102):lang(103)),'<td id="label-type">',lang(49),'<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">',lang(104),'<td>',lang(105);if($U=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="',lang(51),'">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default">',lang(52),(support("comment")?"<td id='label-comment'".($vb?"":" class='hidden'").">".lang(50):"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($p))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".lang(106)."'>".script("row_count = ".count($p).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($p
as$s=>$o){$s++;$Af=$o[($_POST?"orig":"field")];$bc=(isset($_POST["add"][$s-1])||(isset($o["field"])&&!$_POST["drop_col"][$s]))&&(support("drop_col")||$Af=="");echo'<tr',($bc?"":" style='display: none;'"),'>
',($U=="PROCEDURE"?"<td>".html_select("fields[$s][inout]",explode("|",$Qd),$o["inout"]):""),'<th>';if($bc){echo'<input name="fields[',$s,'][field]" value="',h($o["field"]),'" maxlength="64" autocapitalize="off" aria-labelledby="label-name">',script("qsl('input').oninput = function () { editingNameChange.call(this);".($o["field"]!=""||count($p)>1?"":" editingAddRow.call(this);")." };","");}echo'<input type="hidden" name="fields[',$s,'][orig]" value="',h($Af),'">
';edit_type("fields[$s]",$o,$pb,$fd);if($U=="TABLE"){echo'<td>',checkbox("fields[$s][null]",1,$o["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$s,'"';if($o["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td>',checkbox("fields[$s][has_default]",1,$o["has_default"],"","","","label-default"),'<input name="fields[',$s,'][default]" value="',h($o["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td".($vb?"":" class='hidden'")."><input name='fields[$s][comment]' value='".h($o["comment"])."' maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".lang(106)."'> "."<input type='image' class='icon' name='up[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.6.3")."' alt='↑' title='".lang(107)."'> "."<input type='image' class='icon' name='down[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.6.3")."' alt='↓' title='".lang(108)."'> ":""),($Af==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.6.3")."' alt='x' title='".lang(109)."'>":"");}}function
process_fields(&$p){$D=0;if($_POST["up"]){$ne=0;foreach($p
as$y=>$o){if(key($_POST["up"])==$y){unset($p[$y]);array_splice($p,$ne,0,array($o));break;}if(isset($o["field"]))$ne=$D;$D++;}}elseif($_POST["down"]){$hd=false;foreach($p
as$y=>$o){if(isset($o["field"])&&$hd){unset($p[key($_POST["down"])]);array_splice($p,$D,0,array($hd));break;}if(key($_POST["down"])==$y)$hd=$o;$D++;}}elseif($_POST["add"]){$p=array_values($p);array_splice($p,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($B){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($B[0][0].$B[0][0],$B[0][0],substr($B[0],1,-1))),'\\'))."'";}function
grant($md,$mg,$f,$mf){if(!$mg)return
true;if($mg==array("ALL PRIVILEGES","GRANT OPTION"))return($md=="GRANT"?queries("$md ALL PRIVILEGES$mf WITH GRANT OPTION"):queries("$md ALL PRIVILEGES$mf")&&queries("$md GRANT OPTION$mf"));return
queries("$md ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$f, ",$mg).$f).$mf);}function
drop_create($gc,$i,$hc,$Xh,$jc,$A,$Ne,$Le,$Me,$jf,$Ye){if($_POST["drop"])query_redirect($gc,$A,$Ne);elseif($jf=="")query_redirect($i,$A,$Me);elseif($jf!=$Ye){$Gb=queries($i);queries_redirect($A,$Le,$Gb&&queries($gc));if($Gb)queries($hc);}else
queries_redirect($A,$Le,queries($Xh)&&queries($jc)&&queries($gc)&&queries($i));}function
create_trigger($mf,$J){global$x;$ci=" $J[Timing] $J[Event]".($J["Event"]=="UPDATE OF"?" ".idf_escape($J["Of"]):"");return"CREATE TRIGGER ".idf_escape($J["Trigger"]).($x=="mssql"?$mf.$ci:$ci.$mf).rtrim(" $J[Type]\n$J[Statement]",";").";";}function
create_routine($Rg,$J){global$Qd,$x;$O=array();$p=(array)$J["fields"];ksort($p);foreach($p
as$o){if($o["field"]!="")$O[]=(preg_match("~^($Qd)\$~",$o["inout"])?"$o[inout] ":"").idf_escape($o["field"]).process_type($o,"CHARACTER SET");}$Ub=rtrim("\n$J[definition]",";");return"CREATE $Rg ".idf_escape(trim($J["name"]))." (".implode(", ",$O).")".(isset($_GET["function"])?" RETURNS".process_type($J["returns"],"CHARACTER SET"):"").($J["language"]?" LANGUAGE $J[language]":"").($x=="pgsql"?" AS ".q($Ub):"$Ub;");}function
remove_definer($G){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$G);}function
format_foreign_key($q){global$nf;return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$q["source"])).") REFERENCES ".table($q["table"])." (".implode(", ",array_map('idf_escape',$q["target"])).")".(preg_match("~^($nf)\$~",$q["on_delete"])?" ON DELETE $q[on_delete]":"").(preg_match("~^($nf)\$~",$q["on_update"])?" ON UPDATE $q[on_update]":"");}function
tar_file($Vc,$hi){$I=pack("a100a8a8a8a12a12",$Vc,644,0,0,decoct($hi->size),decoct(time()));$hb=8*32;for($s=0;$s<strlen($I);$s++)$hb+=ord($I[$s]);$I.=sprintf("%06o",$hb)."\0 ";echo$I,str_repeat("\0",512-strlen($I));$hi->send();echo
str_repeat("\0",511-($hi->size+511)%512);}function
ini_bytes($Pd){$X=ini_get($Pd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($Wf,$Yh="<sup>?</sup>"){global$x,$g;$ih=$g->server_info;$Ui=preg_replace('~^(\d\.?\d).*~s','\1',$ih);$Ki=array('sql'=>"https://dev.mysql.com/doc/refman/$Ui/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$Ui/static/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://download.oracle.com/docs/cd/B19306_01/server.102/b14200/",);if(preg_match('~MariaDB~',$ih)){$Ki['sql']="https://mariadb.com/kb/en/library/";$Wf['sql']=(isset($Wf['mariadb'])?$Wf['mariadb']:str_replace(".html","/",$Wf['sql']));}return($Wf[$x]?"<a href='$Ki[$x]$Wf[$x]'".target_blank().">$Yh</a>":"");}function
ob_gzencode($Q){return
gzencode($Q);}function
db_size($l){global$g;if(!$g->select_db($l))return"?";$I=0;foreach(table_status()as$S)$I+=$S["Data_length"]+$S["Index_length"];return
format_number($I);}function
set_utf8mb4($i){global$g;static$O=false;if(!$O&&preg_match('~\butf8mb4~i',$i)){$O=true;echo"SET NAMES ".charset($g).";\n\n";}}function
connect_error(){global$b,$g,$ki,$n,$fc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header(lang(38).": ".h(DB),lang(110),true);}else{if($_POST["db"]&&!$n)queries_redirect(substr(ME,0,-1),lang(111),drop_databases($_POST["db"]));page_header(lang(112),$n,false);echo"<p class='links'>\n";foreach(array('database'=>lang(113),'privileges'=>lang(71),'processlist'=>lang(114),'variables'=>lang(115),'status'=>lang(116),)as$y=>$X){if(support($y))echo"<a href='".h(ME)."$y='>$X</a>\n";}echo"<p>".lang(117,$fc[DRIVER],"<b>".h($g->server_info)."</b>","<b>$g->extension</b>")."\n","<p>".lang(118,"<b>".h(logged_user())."</b>")."\n";$k=$b->databases();if($k){$Yg=support("scheme");$pb=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".lang(38)." - <a href='".h(ME)."refresh=1'>".lang(119)."</a>"."<td>".lang(120)."<td>".lang(121)."<td>".lang(122)." - <a href='".h(ME)."dbsize=1'>".lang(123)."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$k=($_GET["dbsize"]?count_tables($k):array_flip($k));foreach($k
as$l=>$T){$Qg=h(ME)."db=".urlencode($l);$t=h("Db-".$l);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$l,in_array($l,(array)$_POST["db"]),"","","",$t):""),"<th><a href='$Qg' id='$t'>".h($l)."</a>";$d=h(db_collation($l,$pb));echo"<td>".(support("database")?"<a href='$Qg".($Yg?"&amp;ns=":"")."&amp;database=' title='".lang(67)."'>$d</a>":$d),"<td align='right'><a href='$Qg&amp;schema=' id='tables-".h($l)."' title='".lang(70)."'>".($_GET["dbsize"]?$T:"?")."</a>","<td align='right' id='size-".h($l)."'>".($_GET["dbsize"]?db_size($l):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".lang(124)." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".lang(125)."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$ki'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header(lang(77).": ".h($_GET["ns"]),lang(126),true);page_footer("ns");exit;}}$nf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Ab){$this->size+=strlen($Ab);fwrite($this->handler,$Ab);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$xc="'(?:''|[^'\\\\]|\\\\.)*'";$Qd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$L=array(idf_escape($_GET["field"]));$H=$m->select($a,$L,array(where($_GET,$p)),$L);$J=($H?$H->fetch_row():array());echo$m->value($J[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$p=fields($a);if(!$p)$n=error();$S=table_status1($a,true);$C=$b->tableName($S);page_header(($p&&is_view($S)?$S['Engine']=='materialized view'?lang(127):lang(128):lang(129)).": ".($C!=""?$C:h($a)),$n);$b->selectLinks($S);$ub=$S["Comment"];if($ub!="")echo"<p class='nowrap'>".lang(50).": ".h($ub)."\n";if($p)$b->tableStructurePrint($p);if(!is_view($S)){if(support("indexes")){echo"<h3 id='indexes'>".lang(130)."</h3>\n";$w=indexes($a);if($w)$b->tableIndexesPrint($w);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.lang(131)."</a>\n";}if(fk_support($S)){echo"<h3 id='foreign-keys'>".lang(98)."</h3>\n";$fd=foreign_keys($a);if($fd){echo"<table cellspacing='0'>\n","<thead><tr><th>".lang(132)."<td>".lang(133)."<td>".lang(101)."<td>".lang(100)."<td></thead>\n";foreach($fd
as$C=>$q){echo"<tr title='".h($C)."'>","<th><i>".implode("</i>, <i>",array_map('h',$q["source"]))."</i>","<td><a href='".h($q["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($q["db"]),ME):($q["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($q["ns"]),ME):ME))."table=".urlencode($q["table"])."'>".($q["db"]!=""?"<b>".h($q["db"])."</b>.":"").($q["ns"]!=""?"<b>".h($q["ns"])."</b>.":"").h($q["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$q["target"]))."</i>)","<td>".h($q["on_delete"])."\n","<td>".h($q["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($C)).'">'.lang(134).'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.lang(135)."</a>\n";}}if(support(is_view($S)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".lang(136)."</h3>\n";$wi=triggers($a);if($wi){echo"<table cellspacing='0'>\n";foreach($wi
as$y=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($y)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($y))."'>".lang(134)."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.lang(137)."</a>\n";}}elseif(isset($_GET["schema"])){page_header(lang(70),"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Nh=array();$Oh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Ce,PREG_SET_ORDER);foreach($Ce
as$s=>$B){$Nh[$B[1]]=array($B[2],$B[3]);$Oh[]="\n\t'".js_escape($B[1])."': [ $B[2], $B[3] ]";}$li=0;$Ra=-1;$Xg=array();$Cg=array();$re=array();foreach(table_status('',true)as$R=>$S){if(is_view($S))continue;$bg=0;$Xg[$R]["fields"]=array();foreach(fields($R)as$C=>$o){$bg+=1.25;$o["pos"]=$bg;$Xg[$R]["fields"][$C]=$o;}$Xg[$R]["pos"]=($Nh[$R]?$Nh[$R]:array($li,0));foreach($b->foreignKeys($R)as$X){if(!$X["db"]){$pe=$Ra;if($Nh[$R][1]||$Nh[$X["table"]][1])$pe=min(floatval($Nh[$R][1]),floatval($Nh[$X["table"]][1]))-1;else$Ra-=.1;while($re[(string)$pe])$pe-=.0001;$Xg[$R]["references"][$X["table"]][(string)$pe]=array($X["source"],$X["target"]);$Cg[$X["table"]][$R][(string)$pe]=$X["target"];$re[(string)$pe]=true;}}$li=max($li,$Xg[$R]["pos"][0]+2.5+$bg);}echo'<div id="schema" style="height: ',$li,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Oh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$li,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($Xg
as$C=>$R){echo"<div class='table' style='top: ".$R["pos"][0]."em; left: ".$R["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($C).'"><b>'.h($C)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($R["fields"]as$o){$X='<span'.type_class($o["type"]).' title="'.h($o["full_type"].($o["null"]?" NULL":'')).'">'.h($o["field"]).'</span>';echo"<br>".($o["primary"]?"<i>$X</i>":$X);}foreach((array)$R["references"]as$Uh=>$Dg){foreach($Dg
as$pe=>$_g){$qe=$pe-$Nh[$C][1];$s=0;foreach($_g[0]as$sh)echo"\n<div class='references' title='".h($Uh)."' id='refs$pe-".($s++)."' style='left: $qe"."em; top: ".$R["fields"][$sh]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$qe)."em;'></div></div>";}}foreach((array)$Cg[$C]as$Uh=>$Dg){foreach($Dg
as$pe=>$f){$qe=$pe-$Nh[$C][1];$s=0;foreach($f
as$Th)echo"\n<div class='references' title='".h($Uh)."' id='refd$pe-".($s++)."' style='left: $qe"."em; top: ".$R["fields"][$Th]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.6.3")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$qe)."em;'></div></div>";}}echo"\n</div>\n";}foreach($Xg
as$C=>$R){foreach((array)$R["references"]as$Uh=>$Dg){foreach($Dg
as$pe=>$_g){$Re=$li;$Ge=-10;foreach($_g[0]as$y=>$sh){$cg=$R["pos"][0]+$R["fields"][$sh]["pos"];$dg=$Xg[$Uh]["pos"][0]+$Xg[$Uh]["fields"][$_g[1][$y]]["pos"];$Re=min($Re,$cg,$dg);$Ge=max($Ge,$cg,$dg);}echo"<div class='references' id='refl$pe' style='left: $pe"."em; top: $Re"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Ge-$Re)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">',lang(138),'</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$n){$Db="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$y)$Db.="&$y=".urlencode($_POST[$y]);cookie("adminer_export",substr($Db,1));$T=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Jc=dump_headers((count($T)==1?key($T):DB),(DB==""||count($T)>1));$Yd=preg_match('~sql~',$_POST["format"]);if($Yd){echo"-- Adminer $ia ".$fc[DRIVER]." dump\n\n";if($x=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
".($_POST["data_style"]?"SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$g->query("SET time_zone = '+00:00';");}}$Eh=$_POST["db_style"];$k=array(DB);if(DB==""){$k=$_POST["databases"];if(is_string($k))$k=explode("\n",rtrim(str_replace("\r","",$k),"\n"));}foreach((array)$k
as$l){$b->dumpDatabase($l);if($g->select_db($l)){if($Yd&&preg_match('~CREATE~',$Eh)&&($i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1))){set_utf8mb4($i);if($Eh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($l).";\n";echo"$i;\n";}if($Yd){if($Eh)echo
use_sql($l).";\n\n";$Gf="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Rg){foreach(get_rows("SHOW $Rg STATUS WHERE Db = ".q($l),null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE $Rg ".idf_escape($J["Name"]),2));set_utf8mb4($i);$Gf.=($Eh!='DROP+CREATE'?"DROP $Rg IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE EVENT ".idf_escape($J["Name"]),3));set_utf8mb4($i);$Gf.=($Eh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}if($Gf)echo"DELIMITER ;;\n\n$Gf"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$Wi=array();foreach(table_status('',true)as$C=>$S){$R=(DB==""||in_array($C,(array)$_POST["tables"]));$Mb=(DB==""||in_array($C,(array)$_POST["data"]));if($R||$Mb){if($Jc=="tar"){$hi=new
TmpFile;ob_start(array($hi,'write'),1e5);}$b->dumpTable($C,($R?$_POST["table_style"]:""),(is_view($S)?2:0));if(is_view($S))$Wi[]=$C;elseif($Mb){$p=fields($C);$b->dumpData($C,$_POST["data_style"],"SELECT *".convert_fields($p,$p)." FROM ".table($C));}if($Yd&&$_POST["triggers"]&&$R&&($wi=trigger_sql($C)))echo"\nDELIMITER ;;\n$wi\nDELIMITER ;\n";if($Jc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$l/")."$C.csv",$hi);}elseif($Yd)echo"\n";}}foreach($Wi
as$Vi)$b->dumpTable($Vi,$_POST["table_style"],1);if($Jc=="tar")echo
pack("x512");}}}if($Yd)echo"-- ".$g->result("SELECT NOW()")."\n";exit;}page_header(lang(73),$n,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0">
';$Qb=array('','USE','DROP+CREATE','CREATE');$Ph=array('','DROP+CREATE','CREATE');$Nb=array('','TRUNCATE+INSERT','INSERT');if($x=="sql")$Nb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$J);if(!$J)$J=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($J["events"])){$J["routines"]=$J["events"]=($_GET["dump"]=="");$J["triggers"]=$J["table_style"];}echo"<tr><th>".lang(139)."<td>".html_select("output",$b->dumpOutput(),$J["output"],0)."\n";echo"<tr><th>".lang(140)."<td>".html_select("format",$b->dumpFormat(),$J["format"],0)."\n";echo($x=="sqlite"?"":"<tr><th>".lang(38)."<td>".html_select('db_style',$Qb,$J["db_style"]).(support("routine")?checkbox("routines",1,$J["routines"],lang(141)):"").(support("event")?checkbox("events",1,$J["events"],lang(142)):"")),"<tr><th>".lang(121)."<td>".html_select('table_style',$Ph,$J["table_style"]).checkbox("auto_increment",1,$J["auto_increment"],lang(51)).(support("trigger")?checkbox("triggers",1,$J["triggers"],lang(136)):""),"<tr><th>".lang(143)."<td>".html_select('data_style',$Nb,$J["data_style"]),'</table>
<p><input type="submit" value="',lang(73),'">
<input type="hidden" name="token" value="',$ki,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$gg=array();if(DB!=""){$fb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$fb>".lang(121)."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".lang(143)."<input type='checkbox' id='check-data'$fb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$Wi="";$Qh=tables_list();foreach($Qh
as$C=>$U){$fg=preg_replace('~_.*~','',$C);$fb=($a==""||$a==(substr($a,-1)=="%"?"$fg%":$C));$jg="<tr><td>".checkbox("tables[]",$C,$fb,$C,"","block");if($U!==null&&!preg_match('~table~i',$U))$Wi.="$jg\n";else
echo"$jg<td align='right'><label class='block'><span id='Rows-".h($C)."'></span>".checkbox("data[]",$C,$fb)."</label>\n";$gg[$fg]++;}echo$Wi;if($Qh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".lang(38)."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$k=$b->databases();if($k){foreach($k
as$l){if(!information_schema($l)){$fg=preg_replace('~_.*~','',$l);echo"<tr><td>".checkbox("databases[]",$l,$a==""||$a=="$fg%",$l,"","block")."\n";$gg[$fg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$Xc=true;foreach($gg
as$y=>$X){if($y!=""&&$X>1){echo($Xc?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$y%")."'>".h($y)."</a>";$Xc=false;}}}elseif(isset($_GET["privileges"])){page_header(lang(71));echo'<p class="links"><a href="'.h(ME).'user=">'.lang(144)."</a>";$H=$g->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$md=$H;if(!$H)$H=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($md?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".lang(36)."<th>".lang(35)."<th></thead>\n";while($J=$H->fetch_assoc())echo'<tr'.odd().'><td>'.h($J["User"])."<td>".h($J["Host"]).'<td><a href="'.h(ME.'user='.urlencode($J["User"]).'&host='.urlencode($J["Host"])).'">'.lang(10)."</a>\n";if(!$md||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".lang(10)."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$n&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$_d=&get_session("queries");$zd=&$_d[DB];if(!$n&&$_POST["clear"]){$zd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?lang(72):lang(64)),$n);if(!$n&&$_POST){$jd=false;if(!isset($_GET["import"]))$G=$_POST["query"];elseif($_POST["webfile"]){$wh=$b->importServerPath();$jd=@fopen((file_exists($wh)?$wh:"compress.zlib://$wh.gz"),"rb");$G=($jd?fread($jd,1e6):false);}else$G=get_file("sql_file",true);if(is_string($G)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($G)+memory_get_usage()+8e6));if($G!=""&&strlen($G)<1e6){$rg=$G.(preg_match("~;[ \t\r\n]*\$~",$G)?"":";");if(!$zd||reset(end($zd))!=$rg){restart_session();$zd[]=array($rg,time());set_session("queries",$_d);stop_session();}}$th="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Wb=";";$D=0;$uc=true;$h=connect();if(is_object($h)&&DB!="")$h->select_db(DB);$tb=0;$zc=array();$Nf='[\'"'.($x=="sql"?'`#':($x=="sqlite"?'`[':($x=="mssql"?'[':''))).']|/\*|-- |$'.($x=="pgsql"?'|\$[^$]*\$':'');$mi=microtime(true);parse_str($_COOKIE["adminer_export"],$ya);$lc=$b->dumpFormat();unset($lc["sql"]);while($G!=""){if(!$D&&preg_match("~^$th*+DELIMITER\\s+(\\S+)~i",$G,$B)){$Wb=$B[1];$G=substr($G,strlen($B[0]));}else{preg_match('('.preg_quote($Wb)."\\s*|$Nf)",$G,$B,PREG_OFFSET_CAPTURE,$D);list($hd,$bg)=$B[0];if(!$hd&&$jd&&!feof($jd))$G.=fread($jd,1e5);else{if(!$hd&&rtrim($G)=="")break;$D=$bg+strlen($hd);if($hd&&rtrim($hd)!=$Wb){while(preg_match('('.($hd=='/*'?'\*/':($hd=='['?']':(preg_match('~^-- |^#~',$hd)?"\n":preg_quote($hd)."|\\\\."))).'|$)s',$G,$B,PREG_OFFSET_CAPTURE,$D)){$Vg=$B[0][0];if(!$Vg&&$jd&&!feof($jd))$G.=fread($jd,1e5);else{$D=$B[0][1]+strlen($Vg);if($Vg[0]!="\\")break;}}}else{$uc=false;$rg=substr($G,0,$bg);$tb++;$jg="<pre id='sql-$tb'><code class='jush-$x'>".$b->sqlCommandQuery($rg)."</code></pre>\n";if($x=="sqlite"&&preg_match("~^$th*+ATTACH\\b~i",$rg,$B)){echo$jg,"<p class='error'>".lang(145)."\n";$zc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$jg;ob_flush();flush();}$_h=microtime(true);if($g->multi_query($rg)&&is_object($h)&&preg_match("~^$th*+USE\\b~i",$rg))$h->query($rg);do{$H=$g->store_result();if($g->error){echo($_POST["only_errors"]?$jg:""),"<p class='error'>".lang(146).($g->errno?" ($g->errno)":"").": ".error()."\n";$zc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break
2;}else{$ai=" <span class='time'>(".format_time($_h).")</span>".(strlen($rg)<1000?" <a href='".h(ME)."sql=".urlencode(trim($rg))."'>".lang(10)."</a>":"");$_a=$g->affected_rows;$Zi=($_POST["only_errors"]?"":$m->warnings());$aj="warnings-$tb";if($Zi)$ai.=", <a href='#$aj'>".lang(46)."</a>".script("qsl('a').onclick = partial(toggle, '$aj');","");$Gc=null;$Hc="explain-$tb";if(is_object($H)){$z=$_POST["limit"];$_f=select($H,$h,array(),$z);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$df=$H->num_rows;echo"<p>".($df?($z&&$df>$z?lang(147,$z):"").lang(148,$df):""),$ai;if($h&&preg_match("~^($th|\\()*+SELECT\\b~i",$rg)&&($Gc=explain($h,$rg)))echo", <a href='#$Hc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Hc');","");$t="export-$tb";echo", <a href='#$t'>".lang(73)."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."<span id='$t' class='hidden'>: ".html_select("output",$b->dumpOutput(),$ya["output"])." ".html_select("format",$lc,$ya["format"])."<input type='hidden' name='query' value='".h($rg)."'>"." <input type='submit' name='export' value='".lang(73)."'><input type='hidden' name='token' value='$ki'></span>\n"."</form>\n";}}else{if(preg_match("~^$th*+(CREATE|DROP|ALTER)$th++(DATABASE|SCHEMA)\\b~i",$rg)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($g->info)."'>".lang(149,$_a)."$ai\n";}echo($Zi?"<div id='$aj' class='hidden'>\n$Zi</div>\n":"");if($Gc){echo"<div id='$Hc' class='hidden'>\n";select($Gc,$h,$_f);echo"</div>\n";}}$_h=microtime(true);}while($g->next_result());}$G=substr($G,$D);$D=0;}}}}if($uc)echo"<p class='message'>".lang(150)."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(151,$tb-count($zc))," <span class='time'>(".format_time($mi).")</span>\n";}elseif($zc&&$tb>1)echo"<p class='error'>".lang(146).": ".implode("",$zc)."\n";}else
echo"<p class='error'>".upload_error($G)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Dc="<input type='submit' value='".lang(152)."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$rg=$_GET["sql"];if($_POST)$rg=$_POST["query"];elseif($_GET["history"]=="all")$rg=$zd;elseif($_GET["history"]!="")$rg=$zd[$_GET["history"]][0];echo"<p>";textarea("query",$rg,20);echo($_POST?"":script("qs('textarea').focus();")),"<p>$Dc\n",lang(153).": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".lang(154)."</legend><div>";$sd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$sd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Dc":lang(155)),"</div></fieldset>\n","<fieldset><legend>".lang(156)."</legend><div>",lang(157,"<code>".h($b->importServerPath())."$sd</code>"),' <input type="submit" name="webfile" value="'.lang(158).'">',"</div></fieldset>\n","<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])),lang(159))."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])),lang(160))."\n","<input type='hidden' name='token' value='$ki'>\n";if(!isset($_GET["import"])&&$zd){print_fieldset("history",lang(161),$_GET["history"]!="");for($X=end($zd);$X;$X=prev($zd)){$y=key($zd);list($rg,$ai,$pc)=$X;echo'<a href="'.h(ME."sql=&history=$y").'">'.lang(10)."</a>"." <span class='time' title='".@date('Y-m-d',$ai)."'>".@date("H:i:s",$ai)."</span>"." <code class='jush-$x'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$rg)))),80,"</code>").($pc?" <span class='time'>($pc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".lang(162)."'>\n","<a href='".h(ME."sql=&history=all")."'>".lang(163)."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Gi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$C=>$o){if(!isset($o["privileges"][$Gi?"update":"insert"])||$b->fieldName($o)=="")unset($p[$C]);}if($_POST&&!$n&&!isset($_GET["select"])){$A=$_POST["referer"];if($_POST["insert"])$A=($Gi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$A))$A=ME."select=".urlencode($a);$w=indexes($a);$Bi=unique_array($_GET["where"],$w);$ug="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($A,lang(164),$m->delete($a,$ug,!$Bi));else{$O=array();foreach($p
as$C=>$o){$X=process_input($o);if($X!==false&&$X!==null)$O[idf_escape($C)]=$X;}if($Gi){if(!$O)redirect($A);queries_redirect($A,lang(165),$m->update($a,$O,$ug,!$Bi));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$H=$m->insert($a,$O);$oe=($H?last_id():0);queries_redirect($A,lang(166,($oe?" $oe":"")),$H);}}}$J=null;if($_POST["save"])$J=(array)$_POST["fields"];elseif($Z){$L=array();foreach($p
as$C=>$o){if(isset($o["privileges"]["select"])){$Ha=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$Ha="''";if($x=="sql"&&preg_match("~enum|set~",$o["type"]))$Ha="1*".idf_escape($C);$L[]=($Ha?"$Ha AS ":"").idf_escape($C);}}$J=array();if(!support("table"))$L=array("*");if($L){$H=$m->select($a,$L,array($Z),$L,array(),(isset($_GET["select"])?2:1));if(!$H)$n=error();else{$J=$H->fetch_assoc();if(!$J)$J=false;}if(isset($_GET["select"])&&(!$J||$H->fetch_assoc()))$J=null;}}if(!support("table")&&!$p){if(!$Z){$H=$m->select($a,array("*"),$Z,array("*"));$J=($H?$H->fetch_assoc():false);if(!$J)$J=array($m->primary=>"");}if($J){foreach($J
as$y=>$X){if(!$Z)$J[$y]=null;$p[$y]=array("field"=>$y,"null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary));}}}edit_form($a,$p,$J,$Gi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Pf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$y)$Pf[$y]=$y;$Bg=referencable_primary($a);$fd=array();foreach($Bg
as$Lh=>$o)$fd[str_replace("`","``",$Lh)."`".str_replace("`","``",$o["field"])]=$Lh;$Cf=array();$S=array();if($a!=""){$Cf=fields($a);$S=table_status($a);if(!$S)$n=lang(9);}$J=$_POST;$J["fields"]=(array)$J["fields"];if($J["auto_increment_col"])$J["fields"][$J["auto_increment_col"]]["auto_increment"]=true;if($_POST&&!process_fields($J["fields"])&&!$n){if($_POST["drop"])queries_redirect(substr(ME,0,-1),lang(167),drop_tables(array($a)));else{$p=array();$Ea=array();$Li=false;$dd=array();$Bf=reset($Cf);$Ba=" FIRST";foreach($J["fields"]as$y=>$o){$q=$fd[$o["type"]];$xi=($q!==null?$Bg[$q]:$o);if($o["field"]!=""){if(!$o["has_default"])$o["default"]=null;if($y==$J["auto_increment_col"])$o["auto_increment"]=true;$og=process_field($o,$xi);$Ea[]=array($o["orig"],$og,$Ba);if($og!=process_field($Bf,$Bf)){$p[]=array($o["orig"],$og,$Ba);if($o["orig"]!=""||$Ba)$Li=true;}if($q!==null)$dd[idf_escape($o["field"])]=($a!=""&&$x!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$fd[$o["type"]],'source'=>array($o["field"]),'target'=>array($xi["field"]),'on_delete'=>$o["on_delete"],));$Ba=" AFTER ".idf_escape($o["field"]);}elseif($o["orig"]!=""){$Li=true;$p[]=array($o["orig"]);}if($o["orig"]!=""){$Bf=next($Cf);if(!$Bf)$Ba="";}}$Rf="";if($Pf[$J["partition_by"]]){$Sf=array();if($J["partition_by"]=='RANGE'||$J["partition_by"]=='LIST'){foreach(array_filter($J["partition_names"])as$y=>$X){$Y=$J["partition_values"][$y];$Sf[]="\n  PARTITION ".idf_escape($X)." VALUES ".($J["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Rf.="\nPARTITION BY $J[partition_by]($J[partition])".($Sf?" (".implode(",",$Sf)."\n)":($J["partitions"]?" PARTITIONS ".(+$J["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$S["Create_options"]))$Rf.="\nREMOVE PARTITIONING";$Ke=lang(168);if($a==""){cookie("adminer_engine",$J["Engine"]);$Ke=lang(169);}$C=trim($J["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($C),$Ke,alter_table($a,$C,($x=="sqlite"&&($Li||$dd)?$Ea:$p),$dd,($J["Comment"]!=$S["Comment"]?$J["Comment"]:null),($J["Engine"]&&$J["Engine"]!=$S["Engine"]?$J["Engine"]:""),($J["Collation"]&&$J["Collation"]!=$S["Collation"]?$J["Collation"]:""),($J["Auto_increment"]!=""?number($J["Auto_increment"]):""),$Rf));}}page_header(($a!=""?lang(44):lang(74)),$n,array("table"=>$a),h($a));if(!$_POST){$J=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($zi["int"])?"int":(isset($zi["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$J=$S;$J["name"]=$a;$J["fields"]=array();if(!$_GET["auto_increment"])$J["Auto_increment"]="";foreach($Cf
as$o){$o["has_default"]=isset($o["default"]);$J["fields"][]=$o;}if(support("partitioning")){$kd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$H=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $kd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($J["partition_by"],$J["partitions"],$J["partition"])=$H->fetch_row();$Sf=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $kd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$Sf[""]="";$J["partition_names"]=array_keys($Sf);$J["partition_values"]=array_values($Sf);}}}$pb=collations();$wc=engines();foreach($wc
as$vc){if(!strcasecmp($vc,$J["Engine"])){$J["Engine"]=$vc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo
lang(170),': <input name="name" maxlength="64" value="',h($J["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($wc?"<select name='Engine'>".optionlist(array(""=>"(".lang(171).")")+$wc,$J["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($pb&&!preg_match("~sqlite|mssql~",$x)?html_select("Collation",array(""=>"(".lang(99).")")+$pb,$J["Collation"]):""),' <input type="submit" value="',lang(14),'">
';}echo'
';if(support("columns")){echo'<table cellspacing="0" id="edit-fields" class="nowrap">
';$vb=($_POST?$_POST["comments"]:$J["Comment"]!="");if(!$_POST&&!$vb){foreach($J["fields"]as$o){if($o["comment"]!=""){$vb=true;break;}}}edit_fields($J["fields"],$pb,"TABLE",$fd,$vb);echo'</table>
<p>
',lang(51),': <input type="number" name="Auto_increment" size="6" value="',h($J["Auto_increment"]),'">
',checkbox("defaults",1,!$_POST||$_POST["defaults"],lang(172),"columnShow(this.checked, 5)","jsonly"),($_POST?"":script("editingHideDefaults();")),(support("comment")?"<label><input type='checkbox' name='comments' value='1' class='jsonly'".($vb?" checked":"").">".lang(50)."</label>".script("qsl('input').onclick = partial(editingCommentsClick, true);").' <input name="Comment" value="'.h($J["Comment"]).'" maxlength="'.(min_version(5.5)?2048:60).'"'.($vb?'':' class="hidden"').'>':''),'<p>
<input type="submit" value="',lang(14),'">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$a));}if(support("partitioning")){$Qf=preg_match('~RANGE|LIST~',$J["partition_by"]);print_fieldset("partition",lang(174),$J["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Pf,$J["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($J["partition"]),'">)
',lang(175),': <input type="number" name="partitions" class="size',($Qf||!$J["partition_by"]?" hidden":""),'" value="',h($J["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Qf?"":" class='hidden'"),'>
<thead><tr><th>',lang(176),'<th>',lang(177),'</thead>
';foreach($J["partition_names"]as$y=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($y==count($J["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($J["partition_values"][$y]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
',script("qs('#form')['defaults'].onclick();".(support("comment")?" editingCommentsClick.call(qs('#form')['comments']);":""));}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Id=array("PRIMARY","UNIQUE","INDEX");$S=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$S["Engine"]))$Id[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$S["Engine"]))$Id[]="SPATIAL";$w=indexes($a);$hg=array();if($x=="mongo"){$hg=$w["_id_"];unset($Id[0]);unset($w["_id_"]);}$J=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($J["indexes"]as$v){$C=$v["name"];if(in_array($v["type"],$Id)){$f=array();$ue=array();$Yb=array();$O=array();ksort($v["columns"]);foreach($v["columns"]as$y=>$e){if($e!=""){$te=$v["lengths"][$y];$Xb=$v["descs"][$y];$O[]=idf_escape($e).($te?"(".(+$te).")":"").($Xb?" DESC":"");$f[]=$e;$ue[]=($te?$te:null);$Yb[]=$Xb;}}if($f){$Ec=$w[$C];if($Ec){ksort($Ec["columns"]);ksort($Ec["lengths"]);ksort($Ec["descs"]);if($v["type"]==$Ec["type"]&&array_values($Ec["columns"])===$f&&(!$Ec["lengths"]||array_values($Ec["lengths"])===$ue)&&array_values($Ec["descs"])===$Yb){unset($w[$C]);continue;}}$c[]=array($v["type"],$C,$O);}}}foreach($w
as$C=>$Ec)$c[]=array($Ec["type"],$C,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),lang(178),alter_indexes($a,$c));}page_header(lang(130),$n,array("table"=>$a),h($a));$p=array_keys(fields($a));if($_POST["add"]){foreach($J["indexes"]as$y=>$v){if($v["columns"][count($v["columns"])]!="")$J["indexes"][$y]["columns"][]="";}$v=end($J["indexes"]);if($v["type"]||array_filter($v["columns"],'strlen'))$J["indexes"][]=array("columns"=>array(1=>""));}if(!$J){foreach($w
as$y=>$v){$w[$y]["name"]=$y;$w[$y]["columns"][]="";}$w[]=array("columns"=>array(1=>""));$J["indexes"]=$w;}echo'
<form action="" method="post">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">',lang(179),'<th><input type="submit" class="wayoff">',lang(180),'<th id="label-name">',lang(181),'<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".lang(106)."'>",'</noscript>
</thead>
';if($hg){echo"<tr><td>PRIMARY<td>";foreach($hg["columns"]as$y=>$e){echo
select_input(" disabled",$p,$e),"<label><input disabled type='checkbox'>".lang(59)."</label> ";}echo"<td><td>\n";}$be=1;foreach($J["indexes"]as$v){if(!$_POST["drop_col"]||$be!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$be][type]",array(-1=>"")+$Id,$v["type"],($be==count($J["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($v["columns"]);$s=1;foreach($v["columns"]as$y=>$e){echo"<span>".select_input(" name='indexes[$be][columns][$s]' title='".lang(48)."'",($p?array_combine($p,$p):$p),$e,"partial(".($s==count($v["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($x=="sql"?"":$_GET["indexes"]."_")."')"),($x=="sql"||$x=="mssql"?"<input type='number' name='indexes[$be][lengths][$s]' class='size' value='".h($v["lengths"][$y])."' title='".lang(104)."'>":""),($x!="sql"?checkbox("indexes[$be][descs][$s]",1,$v["descs"][$y],lang(59)):"")," </span>";$s++;}echo"<td><input name='indexes[$be][name]' value='".h($v["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$be]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.6.3")."' alt='x' title='".lang(109)."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$be++;}echo'</table>
<p>
<input type="submit" value="',lang(14),'">
<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["database"])){$J=$_POST;if($_POST&&!$n&&!isset($_POST["add_x"])){$C=trim($J["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),lang(182),drop_databases(array(DB)));}elseif(DB!==$C){if(DB!=""){$_GET["db"]=$C;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($C),lang(183),rename_database($C,$J["collation"]));}else{$k=explode("\n",str_replace("\r","",$C));$Fh=true;$ne="";foreach($k
as$l){if(count($k)==1||$l!=""){if(!create_database($l,$J["collation"]))$Fh=false;$ne=$l;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($ne),lang(184),$Fh);}}else{if(!$J["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($C).(preg_match('~^[a-z0-9_]+$~i',$J["collation"])?" COLLATE $J[collation]":""),substr(ME,0,-1),lang(185));}}page_header(DB!=""?lang(67):lang(113),$n,array(),h(DB));$pb=collations();$C=DB;if($_POST)$C=$J["name"];elseif(DB!="")$J["collation"]=db_collation(DB,$pb);elseif($x=="sql"){foreach(get_vals("SHOW GRANTS")as$md){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$md,$B)&&$B[1]){$C=stripcslashes(idf_unescape("`$B[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($C,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($C).'</textarea><br>':'<input name="name" id="name" value="'.h($C).'" maxlength="64" autocapitalize="off">')."\n".($pb?html_select("collation",array(""=>"(".lang(99).")")+$pb,$J["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="',lang(14),'">
';if(DB!="")echo"<input type='submit' name='drop' value='".lang(125)."'>".confirm(lang(173,DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.6.3")."' alt='+' title='".lang(106)."'>\n";echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["scheme"])){$J=$_POST;if($_POST&&!$n){$_=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$_,lang(186));else{$C=trim($J["name"]);$_.=urlencode($C);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($C),$_,lang(187));elseif($_GET["ns"]!=$C)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($C),$_,lang(188));else
redirect($_);}}page_header($_GET["ns"]!=""?lang(68):lang(69),$n);if(!$J)$J["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($J["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="',lang(14),'">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".lang(125)."'>".confirm(lang(173,$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header(lang(189).": ".h($da),$n);$Rg=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Gd=array();$Gf=array();foreach($Rg["fields"]as$s=>$o){if(substr($o["inout"],-3)=="OUT")$Gf[$s]="@".idf_escape($o["field"])." AS ".idf_escape($o["field"]);if(!$o["inout"]||substr($o["inout"],0,2)=="IN")$Gd[]=$s;}if(!$n&&$_POST){$ab=array();foreach($Rg["fields"]as$y=>$o){if(in_array($y,$Gd)){$X=process_input($o);if($X===false)$X="''";if(isset($Gf[$y]))$g->query("SET @".idf_escape($o["field"])." = $X");}$ab[]=(isset($Gf[$y])?"@".idf_escape($o["field"]):$X);}$G=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$ab).")";$_h=microtime(true);$H=$g->multi_query($G);$_a=$g->affected_rows;echo$b->selectQuery($G,$_h,!$H);if(!$H)echo"<p class='error'>".error()."\n";else{$h=connect();if(is_object($h))$h->select_db(DB);do{$H=$g->store_result();if(is_object($H))select($H,$h);else
echo"<p class='message'>".lang(190,$_a)."\n";}while($g->next_result());if($Gf)select($g->query("SELECT ".implode(", ",$Gf)));}}echo'
<form action="" method="post">
';if($Gd){echo"<table cellspacing='0'>\n";foreach($Gd
as$y){$o=$Rg["fields"][$y];$C=$o["field"];echo"<tr><th>".$b->fieldName($o);$Y=$_POST["fields"][$C];if($Y!=""){if($o["type"]=="enum")$Y=+$Y;if($o["type"]=="set")$Y=array_sum($Y);}input($o,$Y,(string)$_POST["function"][$C]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="',lang(189),'">
<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$C=$_GET["name"];$J=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Ke=($_POST["drop"]?lang(191):($C!=""?lang(192):lang(193)));$A=ME."table=".urlencode($a);if(!$_POST["drop"]){$J["source"]=array_filter($J["source"],'strlen');ksort($J["source"]);$Th=array();foreach($J["source"]as$y=>$X)$Th[$y]=$J["target"][$y];$J["target"]=$Th;}if($x=="sqlite")queries_redirect($A,$Ke,recreate_table($a,$a,array(),array(),array(" $C"=>($_POST["drop"]?"":" ".format_foreign_key($J)))));else{$c="ALTER TABLE ".table($a);$gc="\nDROP ".($x=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($C);if($_POST["drop"])query_redirect($c.$gc,$A,$Ke);else{query_redirect($c.($C!=""?"$gc,":"")."\nADD".format_foreign_key($J),$A,$Ke);$n=lang(194)."<br>$n";}}}page_header(lang(195),$n,array("table"=>$a),h($a));if($_POST){ksort($J["source"]);if($_POST["add"])$J["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$J["target"]=array();}elseif($C!=""){$fd=foreign_keys($a);$J=$fd[$C];$J["source"][]="";}else{$J["table"]=$a;$J["source"]=array("");}$sh=array_keys(fields($a));$Th=($a===$J["table"]?$sh:array_keys(fields($J["table"])));$Ag=array_keys(array_filter(table_status('',true),'fk_support'));echo'
<form action="" method="post">
<p>
';if($J["db"]==""&&$J["ns"]==""){echo
lang(196),':
',html_select("table",$Ag,$J["table"],"this.form['change-js'].value = '1'; this.form.submit();"),'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="',lang(197),'"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">',lang(132),'<th id="label-target">',lang(133),'</thead>
';$be=0;foreach($J["source"]as$y=>$X){echo"<tr>","<td>".html_select("source[".(+$y)."]",array(-1=>"")+$sh,$X,($be==count($J["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$y)."]",$Th,$J["target"][$y],1,"label-target");$be++;}echo'</table>
<p>
',lang(101),': ',html_select("on_delete",array(-1=>"")+explode("|",$nf),$J["on_delete"]),' ',lang(100),': ',html_select("on_update",array(-1=>"")+explode("|",$nf),$J["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="',lang(14),'">
<noscript><p><input type="submit" name="add" value="',lang(198),'"></noscript>
';}if($C!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$C));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$J=$_POST;$Df="VIEW";if($x=="pgsql"&&$a!=""){$P=table_status($a);$Df=strtoupper($P["Engine"]);}if($_POST&&!$n){$C=trim($J["name"]);$Ha=" AS\n$J[select]";$A=ME."table=".urlencode($C);$Ke=lang(199);$U=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$C&&$x!="sqlite"&&$U=="VIEW"&&$Df=="VIEW")query_redirect(($x=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($C).$Ha,$A,$Ke);else{$Vh=$C."_adminer_".uniqid();drop_create("DROP $Df ".table($a),"CREATE $U ".table($C).$Ha,"DROP $U ".table($C),"CREATE $U ".table($Vh).$Ha,"DROP $U ".table($Vh),($_POST["drop"]?substr(ME,0,-1):$A),lang(200),$Ke,lang(201),$a,$C);}}if(!$_POST&&$a!=""){$J=view($a);$J["name"]=$a;$J["materialized"]=($Df!="VIEW");if(!$n)$n=error();}page_header(($a!=""?lang(43):lang(202)),$n,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>',lang(181),': <input name="name" value="',h($J["name"]),'" maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$J["materialized"],lang(127)):""),'<p>';textarea("select",$J["select"]);echo'<p>
<input type="submit" value="',lang(14),'">
';if($a!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$a));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$Td=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Bh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$J=$_POST;if($_POST&&!$n){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),lang(203));elseif(in_array($J["INTERVAL_FIELD"],$Td)&&isset($Bh[$J["STATUS"]])){$Wg="\nON SCHEDULE ".($J["INTERVAL_VALUE"]?"EVERY ".q($J["INTERVAL_VALUE"])." $J[INTERVAL_FIELD]".($J["STARTS"]?" STARTS ".q($J["STARTS"]):"").($J["ENDS"]?" ENDS ".q($J["ENDS"]):""):"AT ".q($J["STARTS"]))." ON COMPLETION".($J["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?lang(204):lang(205)),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$Wg.($aa!=$J["EVENT_NAME"]?"\nRENAME TO ".idf_escape($J["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($J["EVENT_NAME"]).$Wg)."\n".$Bh[$J["STATUS"]]." COMMENT ".q($J["EVENT_COMMENT"]).rtrim(" DO\n$J[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?lang(206).": ".h($aa):lang(207)),$n);if(!$J&&$aa!=""){$K=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$J=reset($K);}echo'
<form action="" method="post">
<table cellspacing="0">
<tr><th>',lang(181),'<td><input name="EVENT_NAME" value="',h($J["EVENT_NAME"]),'" maxlength="64" autocapitalize="off">
<tr><th title="datetime">',lang(208),'<td><input name="STARTS" value="',h("$J[EXECUTE_AT]$J[STARTS]"),'">
<tr><th title="datetime">',lang(209),'<td><input name="ENDS" value="',h($J["ENDS"]),'">
<tr><th>',lang(210),'<td><input type="number" name="INTERVAL_VALUE" value="',h($J["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$Td,$J["INTERVAL_FIELD"]),'<tr><th>',lang(116),'<td>',html_select("STATUS",$Bh,$J["STATUS"]),'<tr><th>',lang(50),'<td><input name="EVENT_COMMENT" value="',h($J["EVENT_COMMENT"]),'" maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$J["ON_COMPLETION"]=="PRESERVE",lang(211)),'</table>
<p>';textarea("EVENT_DEFINITION",$J["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="',lang(14),'">
';if($aa!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$aa));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Rg=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$J=$_POST;$J["fields"]=(array)$J["fields"];if($_POST&&!process_fields($J["fields"])&&!$n){$Af=routine($_GET["procedure"],$Rg);$Vh="$J[name]_adminer_".uniqid();drop_create("DROP $Rg ".routine_id($da,$Af),create_routine($Rg,$J),"DROP $Rg ".routine_id($J["name"],$J),create_routine($Rg,array("name"=>$Vh)+$J),"DROP $Rg ".routine_id($Vh,$J),substr(ME,0,-1),lang(212),lang(213),lang(214),$da,$J["name"]);}page_header(($da!=""?(isset($_GET["function"])?lang(215):lang(216)).": ".h($da):(isset($_GET["function"])?lang(217):lang(218))),$n);if(!$_POST&&$da!=""){$J=routine($_GET["procedure"],$Rg);$J["name"]=$da;}$pb=get_vals("SHOW CHARACTER SET");sort($pb);$Sg=routine_languages();echo'
<form action="" method="post" id="form">
<p>',lang(181),': <input name="name" value="',h($J["name"]),'" maxlength="64" autocapitalize="off">
',($Sg?lang(19).": ".html_select("language",$Sg,$J["language"])."\n":""),'<input type="submit" value="',lang(14),'">
<table cellspacing="0" class="nowrap">
';edit_fields($J["fields"],$pb,$Rg);if(isset($_GET["function"])){echo"<tr><td>".lang(219);edit_type("returns",$J["returns"],$pb,array(),($x=="pgsql"?array("void","trigger"):array()));}echo'</table>
<p>';textarea("definition",$J["definition"]);echo'<p>
<input type="submit" value="',lang(14),'">
';if($da!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$da));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$J=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);$C=trim($J["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$_,lang(220));elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($C),$_,lang(221));elseif($fa!=$C)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($C),$_,lang(222));else
redirect($_);}page_header($fa!=""?lang(223).": ".h($fa):lang(224),$n);if(!$J)$J["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($J["name"]),'" autocapitalize="off">
<input type="submit" value="',lang(14),'">
';if($fa!="")echo"<input type='submit' name='drop' value='".lang(125)."'>".confirm(lang(173,$fa))."\n";echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$J=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$_,lang(225));else
query_redirect("CREATE TYPE ".idf_escape(trim($J["name"]))." $J[as]",$_,lang(226));}page_header($ga!=""?lang(227).": ".h($ga):lang(228),$n);if(!$J)$J["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".lang(125)."'>".confirm(lang(173,$ga))."\n";else{echo"<input name='name' value='".h($J['name'])."' autocapitalize='off'>\n";textarea("as",$J["as"]);echo"<p><input type='submit' value='".lang(14)."'>\n";}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$C=$_GET["name"];$vi=trigger_options();$J=(array)trigger($C)+array("Trigger"=>$a."_bi");if($_POST){if(!$n&&in_array($_POST["Timing"],$vi["Timing"])&&in_array($_POST["Event"],$vi["Event"])&&in_array($_POST["Type"],$vi["Type"])){$mf=" ON ".table($a);$gc="DROP TRIGGER ".idf_escape($C).($x=="pgsql"?$mf:"");$A=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($gc,$A,lang(229));else{if($C!="")queries($gc);queries_redirect($A,($C!=""?lang(230):lang(231)),queries(create_trigger($mf,$_POST)));if($C!="")queries(create_trigger($mf,$J+array("Type"=>reset($vi["Type"]))));}}$J=$_POST;}page_header(($C!=""?lang(232).": ".h($C):lang(233)),$n,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0">
<tr><th>',lang(234),'<td>',html_select("Timing",$vi["Timing"],$J["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>',lang(235),'<td>',html_select("Event",$vi["Event"],$J["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$vi["Event"])?" <input name='Of' value='".h($J["Of"])."' class='hidden'>":""),'<tr><th>',lang(49),'<td>',html_select("Type",$vi["Type"],$J["Type"]),'</table>
<p>',lang(181),': <input name="Trigger" value="',h($J["Trigger"]),'" maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$J["Statement"]);echo'<p>
<input type="submit" value="',lang(14),'">
';if($C!=""){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,$C));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$mg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$J){foreach(explode(",",($J["Privilege"]=="Grant option"?"":$J["Context"]))as$Bb)$mg[$Bb][$J["Privilege"]]=$J["Comment"];}$mg["Server Admin"]+=$mg["File access on server"];$mg["Databases"]["Create routine"]=$mg["Procedures"]["Create routine"];unset($mg["Procedures"]["Create routine"]);$mg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$mg["Columns"][$X]=$mg["Tables"][$X];unset($mg["Server Admin"]["Usage"]);foreach($mg["Tables"]as$y=>$X)unset($mg["Databases"][$y]);$Xe=array();if($_POST){foreach($_POST["objects"]as$y=>$X)$Xe[$X]=(array)$Xe[$X]+(array)$_POST["grants"][$y];}$nd=array();$kf="";if(isset($_GET["host"])&&($H=$g->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($J=$H->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$J[0],$B)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$B[1],$Ce,PREG_SET_ORDER)){foreach($Ce
as$X){if($X[1]!="USAGE")$nd["$B[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$J[0]))$nd["$B[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$J[0],$B))$kf=$B[1];}}if($_POST&&!$n){$lf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $lf",ME."privileges=",lang(236));else{$Ze=q($_POST["user"])."@".q($_POST["host"]);$Uf=$_POST["pass"];if($Uf!=''&&!$_POST["hashed"]){$Uf=$g->result("SELECT PASSWORD(".q($Uf).")");$n=!$Uf;}$Gb=false;if(!$n){if($lf!=$Ze){$Gb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $Ze IDENTIFIED BY PASSWORD ".q($Uf));$n=!$Gb;}elseif($Uf!=$kf)queries("SET PASSWORD FOR $Ze = ".q($Uf));}if(!$n){$Og=array();foreach($Xe
as$ff=>$md){if(isset($_GET["grant"]))$md=array_filter($md);$md=array_keys($md);if(isset($_GET["grant"]))$Og=array_diff(array_keys(array_filter($Xe[$ff],'strlen')),$md);elseif($lf==$Ze){$if=array_keys((array)$nd[$ff]);$Og=array_diff($if,$md);$md=array_diff($md,$if);unset($nd[$ff]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$ff,$B)&&(!grant("REVOKE",$Og,$B[2]," ON $B[1] FROM $Ze")||!grant("GRANT",$md,$B[2]," ON $B[1] TO $Ze"))){$n=true;break;}}}if(!$n&&isset($_GET["host"])){if($lf!=$Ze)queries("DROP USER $lf");elseif(!isset($_GET["grant"])){foreach($nd
as$ff=>$Og){if(preg_match('~^(.+)(\(.*\))?$~U',$ff,$B))grant("REVOKE",array_keys($Og),$B[2]," ON $B[1] FROM $Ze");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?lang(237):lang(238)),!$n);if($Gb)$g->query("DROP USER $Ze");}}page_header((isset($_GET["host"])?lang(36).": ".h("$ha@$_GET[host]"):lang(144)),$n,array("privileges"=>array('',lang(71))));if($_POST){$J=$_POST;$nd=$Xe;}else{$J=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$J["pass"]=$kf;if($kf!="")$J["hashed"]=true;$nd[(DB==""||$nd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0">
<tr><th>',lang(35),'<td><input name="host" maxlength="60" value="',h($J["host"]),'" autocapitalize="off">
<tr><th>',lang(36),'<td><input name="user" maxlength="16" value="',h($J["user"]),'" autocapitalize="off">
<tr><th>',lang(37),'<td><input name="pass" id="pass" value="',h($J["pass"]),'" autocomplete="new-password">
';if(!$J["hashed"])echo
script("typePassword(qs('#pass'));");echo
checkbox("hashed",1,$J["hashed"],lang(239),"typePassword(this.form['pass'], this.checked);"),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".lang(71).doc_link(array('sql'=>"grant.html#priv_level"));$s=0;foreach($nd
as$ff=>$md){echo'<th>'.($ff!="*.*"?"<input name='objects[$s]' value='".h($ff)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$s]' value='*.*' size='10'>*.*");$s++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>lang(35),"Databases"=>lang(38),"Tables"=>lang(129),"Columns"=>lang(48),"Procedures"=>lang(240),)as$Bb=>$Xb){foreach((array)$mg[$Bb]as$lg=>$ub){echo"<tr".odd()."><td".($Xb?">$Xb<td":" colspan='2'").' lang="en" title="'.h($ub).'">'.h($lg);$s=0;foreach($nd
as$ff=>$md){$C="'grants[$s][".h(strtoupper($lg))."]'";$Y=$md[strtoupper($lg)];if($Bb=="Server Admin"&&$ff!=(isset($nd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$C><option><option value='1'".($Y?" selected":"").">".lang(241)."<option value='0'".($Y=="0"?" selected":"").">".lang(242)."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$C value='1'".($Y?" checked":"").($lg=="All privileges"?" id='grants-$s-all'>":">".($lg=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$s-all'); };"))),"</label>";}$s++;}}}echo"</table>\n",'<p>
<input type="submit" value="',lang(14),'">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="',lang(125),'">',confirm(lang(173,"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$n){$ie=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$ie++;}queries_redirect(ME."processlist=",lang(243,$ie),$ie||!$_POST["kill"]);}page_header(lang(114),$n);echo'
<form action="" method="post">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$s=-1;foreach(process_list()as$s=>$J){if(!$s){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($J
as$y=>$X)echo"<th>$y".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($y),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"../b14237/dynviews_2088.htm",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$J[$x=="sql"?"Id":"pid"],0):"");foreach($J
as$y=>$X)echo"<td>".(($x=="sql"&&$y=="Info"&&preg_match("~Query|Killed~",$J["Command"])&&$X!="")||($x=="pgsql"&&$y=="current_query"&&$X!="<IDLE>")||($x=="oracle"&&$y=="sql_text"&&$X!="")?"<code class='jush-$x'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($J["db"]!=""?"db=".urlencode($J["db"])."&":"")."sql=".urlencode($X)).'">'.lang(244).'</a>':h($X));echo"\n";}echo'</table>
<p>
';if(support("kill")){echo($s+1)."/".lang(245,max_connections()),"<p><input type='submit' value='".lang(246)."'>\n";}echo'<input type="hidden" name="token" value="',$ki,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$w=indexes($a);$p=fields($a);$fd=column_foreign_keys($a);$hf=$S["Oid"];parse_str($_COOKIE["adminer_import"],$za);$Pg=array();$f=array();$Zh=null;foreach($p
as$y=>$o){$C=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$C!=""){$f[$y]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($o))$Zh=$b->selectLengthProcess();}$Pg+=$o["privileges"];}list($L,$od)=$b->selectColumnsProcess($f,$w);$Xd=count($od)<count($L);$Z=$b->selectSearchProcess($p,$w);$xf=$b->selectOrderProcess($p,$w);$z=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Ci=>$J){$Ha=convert_field($p[key($J)]);$L=array($Ha?$Ha:idf_escape(key($J)));$Z[]=where_check($Ci,$p);$I=$m->select($a,$L,$Z,$L);if($I)echo
reset($I->fetch_row());}exit;}$hg=$Ei=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$hg=array_flip($v["columns"]);$Ei=($L?$hg:array());foreach($Ei
as$y=>$X){if(in_array(idf_escape($y),$L))unset($Ei[$y]);}break;}}if($hf&&!$hg){$hg=$Ei=array($hf=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($hf));}if($_POST&&!$n){$fj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$gb=array();foreach($_POST["check"]as$db)$gb[]=where_check($db,$p);$fj[]="((".implode(") OR (",$gb)."))";}$fj=($fj?"\nWHERE ".implode(" AND ",$fj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$kd=($L?implode(", ",$L):"*").convert_fields($f,$p,$L)."\nFROM ".table($a);$qd=($od&&$Xd?"\nGROUP BY ".implode(", ",$od):"").($xf?"\nORDER BY ".implode(", ",$xf):"");if(!is_array($_POST["check"])||$hg)$G="SELECT $kd$fj$qd";else{$Ai=array();foreach($_POST["check"]as$X)$Ai[]="(SELECT".limit($kd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$qd,1).")";$G=implode(" UNION ALL ",$Ai);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$fd)){if($_POST["save"]||$_POST["delete"]){$H=true;$_a=0;$O=array();if(!$_POST["delete"]){foreach($f
as$C=>$X){$X=process_input($p[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$O[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$O){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($O)).")\nSELECT ".implode(", ",$O)."\nFROM ".table($a);if($_POST["all"]||($hg&&is_array($_POST["check"]))||$Xd){$H=($_POST["delete"]?$m->delete($a,$fj):($_POST["clone"]?queries("INSERT $G$fj"):$m->update($a,$O,$fj)));$_a=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$bj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$H=($_POST["delete"]?$m->delete($a,$bj,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$bj)):$m->update($a,$O,$bj,1)));if(!$H)break;$_a+=$g->affected_rows;}}}$Ke=lang(247,$_a);if($_POST["clone"]&&$H&&$_a==1){$oe=last_id();if($oe)$Ke=lang(166," $oe");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Ke,$H);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n=lang(248);else{$H=true;$_a=0;foreach($_POST["val"]as$Ci=>$J){$O=array();foreach($J
as$y=>$X){$y=bracket_escape($y,1);$O[idf_escape($y)]=(preg_match('~char|text~',$p[$y]["type"])||$X!=""?$b->processInput($p[$y],$X):"NULL");}$H=$m->update($a,$O," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Ci,$p),!$Xd&&!$hg," ");if(!$H)break;$_a+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(247,$_a),$H);}}elseif(!is_string($Uc=get_file("csv_file",true)))$n=upload_error($Uc);elseif(!preg_match('~~u',$Uc))$n=lang(249);else{cookie("adminer_import","output=".urlencode($za["output"])."&format=".urlencode($_POST["separator"]));$H=true;$rb=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Uc,$Ce);$_a=count($Ce[0]);$m->begin();$M=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$K=array();foreach($Ce[0]as$y=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$M]*)$M~",$X.$M,$De);if(!$y&&!array_diff($De[1],$rb)){$rb=$De[1];$_a--;}else{$O=array();foreach($De[1]as$s=>$nb)$O[idf_escape($rb[$s])]=($nb==""&&$p[$rb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$nb))));$K[]=$O;}}$H=(!$K||$m->insertUpdate($a,$K,$hg));if($H)$H=$m->commit();queries_redirect(remove_from_uri("page"),lang(250,$_a),$H);$m->rollback();}}}$Lh=$b->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(53).": $Lh",$n);$O=null;if(isset($Pg["insert"])||!support("table")){$O="";foreach((array)$_GET["where"]as$X){if($fd[$X["col"]]&&count($fd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$O.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($S,$O);if(!$f&&support("table"))echo"<p class='error'>".lang(251).($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($L,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($xf,$f,$w);$b->selectLimitPrint($z);$b->selectLengthPrint($Zh);$b->selectActionPrint($w);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$id=$g->result(count_rows($a,$Z,$Xd,$od));$E=floor(max(0,$id-1)/$z);}$bh=$L;$pd=$od;if(!$bh){$bh[]="*";$Cb=convert_fields($f,$p,$L);if($Cb)$bh[]=substr($Cb,2);}foreach($L
as$y=>$X){$o=$p[idf_unescape($X)];if($o&&($Ha=convert_field($o)))$bh[$y]="$Ha AS $X";}if(!$Xd&&$Ei){foreach($Ei
as$y=>$X){$bh[]=idf_escape($y);if($pd)$pd[]=idf_escape($y);}}$H=$m->select($a,$bh,$Z,$pd,$xf,$z,$E,true);if(!$H)echo"<p class='error'>".error()."\n";else{if($x=="mssql"&&$E)$H->seek($z*$E);$tc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$K=array();while($J=$H->fetch_assoc()){if($E&&$x=="oracle")unset($J["RNUM"]);$K[]=$J;}if($_GET["page"]!="last"&&$z!=""&&$od&&$Xd&&$x=="sql")$id=$g->result(" SELECT FOUND_ROWS()");if(!$K)echo"<p class='message'>".lang(12)."\n";else{$Qa=$b->backwardKeys($a,$Lh);echo"<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$od&&$L?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(252)."</a>");$We=array();$ld=array();reset($L);$wg=1;foreach($K[0]as$y=>$X){if(!isset($Ei[$y])){$X=$_GET["columns"][key($L)];$o=$p[$L?($X?$X["col"]:current($L)):$y];$C=($o?$b->fieldName($o,$wg):($X["fun"]?"*":$y));if($C!=""){$wg++;$We[$y]=$C;$e=idf_escape($y);$Cd=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($y);$Xb="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Cd.($xf[0]==$e||$xf[0]==$y||(!$xf&&$Xd&&$od[0]==$e)?$Xb:'')).'">';echo
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Cd.$Xb)."' title='".lang(59)."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(56).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($y)."');");}echo"</span>";}$ld[$y]=$X["fun"];next($L);}}$ue=array();if($_GET["modify"]){foreach($K
as$J){foreach($J
as$y=>$X)$ue[$y]=max($ue[$y],min(40,strlen(utf8_decode($X))));}}echo($Qa?"<th>".lang(253):"")."</thead>\n";if(is_ajax()){if($z%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($K,$fd)as$Ve=>$J){$Bi=unique_array($K[$Ve],$w);if(!$Bi){$Bi=array();foreach($K[$Ve]as$y=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$y))$Bi[$y]=$X;}}$Ci="";foreach($Bi
as$y=>$X){if(($x=="sql"||$x=="pgsql")&&preg_match('~char|text|enum|set~',$p[$y]["type"])&&strlen($X)>64){$y=(strpos($y,'(')?$y:idf_escape($y));$y="MD5(".($x!='sql'||preg_match("~^utf8~",$p[$y]["collation"])?$y:"CONVERT($y USING ".charset($g).")").")";$X=md5($X);}$Ci.="&".($X!==null?urlencode("where[".bracket_escape($y)."]")."=".urlencode($X):"null%5B%5D=".urlencode($y));}echo"<tr".odd().">".(!$od&&$L?"":"<td>".checkbox("check[]",substr($Ci,1),in_array(substr($Ci,1),(array)$_POST["check"])).($Xd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Ci)."' class='edit'>".lang(254)."</a>"));foreach($J
as$y=>$X){if(isset($We[$y])){$o=$p[$y];$X=$m->value($X,$o);if($X!=""&&(!isset($tc[$y])||$tc[$y]!=""))$tc[$y]=(is_mail($X)?$We[$y]:"");$_="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$_=ME.'download='.urlencode($a).'&field='.urlencode($y).$Ci;if(!$_&&$X!==null){foreach((array)$fd[$y]as$q){if(count($fd[$y])==1||end($q["source"])==$y){$_="";foreach($q["source"]as$s=>$sh)$_.=where_link($s,$q["target"][$s],$K[$Ve][$sh]);$_=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$_;if($q["ns"])$_=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$_);if(count($q["source"])==1)break;}}}if($y=="COUNT(*)"){$_=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Bi))$_.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Bi
as$ce=>$W)$_.=where_link($s++,$ce,$W);}$X=select_value($X,$_,$o,$Zh);$t=h("val[$Ci][".bracket_escape($y)."]");$Y=$_POST["val"][$Ci][bracket_escape($y)];$oc=!is_array($J[$y])&&is_utf8($X)&&$K[$Ve][$y]==$J[$y]&&!$ld[$y];$Yh=preg_match('~text|lob~',$o["type"]);if(($_GET["modify"]&&$oc)||$Y!==null){$td=h($Y!==null?$Y:$J[$y]);echo"<td>".($Yh?"<textarea name='$t' cols='30' rows='".(substr_count($J[$y],"\n")+1)."'>$td</textarea>":"<input name='$t' value='$td' size='$ue[$y]'>");}else{$ye=strpos($X,"<i>...</i>");echo"<td id='$t' data-text='".($ye?2:($Yh?1:0))."'".($oc?"":" data-warning='".h(lang(255))."'").">$X</td>";}}}if($Qa)echo"<td>";$b->backwardKeysPrint($Qa,$K[$Ve]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n";}if(!is_ajax()){if($K||$E){$Cc=true;if($_GET["page"]!="last"){if($z==""||(count($K)<$z&&($K||!$E)))$id=($E?$E*$z:0)+count($K);elseif($x!="sql"||!$Xd){$id=($Xd?false:found_rows($S,$Z));if($id<max(1e4,2*($E+1)*$z))$id=reset(slow_query(count_rows($a,$Z,$Xd,$od)));else$Cc=false;}}$Jf=($z!=""&&($id===false||$id>$z||$E));if($Jf){echo(($id===false?count($K)+1:$id-$E*$z)>$z?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.lang(256).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$z).", '".lang(257)."...');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($K||$E){if($Jf){$Fe=($id===false?$E+(count($K)>=$z?2:1):floor(($id-1)/$z));echo"<fieldset>";if($x!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(258)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(258)."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" ...":"");for($s=max(1,$E-4);$s<min($Fe,$E+5);$s++)echo
pagination($s,$E);if($Fe>0){echo($E+5<$Fe?" ...":""),($Cc&&$id!==false?pagination($Fe,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Fe'>".lang(259)."</a>");}}else{echo"<legend>".lang(258)."</legend>",pagination(0,$E).($E>1?" ...":""),($E?pagination($E,$E):""),($Fe>$E?pagination($E+1,$E).($Fe>$E+1?" ...":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(260)."</legend>";$cc=($Cc?"":"~ ").$id;echo
checkbox("all",1,0,($id!==false?($Cc?"":"~ ").lang(148,$id):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$cc' : checked); selectCount('selected2', this.checked || !checked ? '$cc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(252),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(248).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(124),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(244),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$gd=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($gd['sql']);break;}}if($gd){print_fieldset("export",lang(73)." <span id='selected2'></span>");$Hf=$b->dumpOutput();echo($Hf?html_select("output",$Hf,$za["output"])." ":""),html_select("format",$gd,$za["format"])," <input type='submit' name='export' value='".lang(73)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($tc,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(72)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$za["format"],1);echo" <input type='submit' name='import' value='".lang(72)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$ki'>\n","</form>\n",(!$od&&$L?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$P=isset($_GET["status"]);page_header($P?lang(116):lang(115));$Si=($P?show_status():show_variables());if(!$Si)echo"<p class='message'>".lang(12)."\n";else{echo"<table cellspacing='0'>\n";foreach($Si
as$y=>$X){echo"<tr>","<th><code class='jush-".$x.($P?"status":"set")."'>".h($y)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Ih=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$C=>$S){json_row("Comment-$C",h($S["Comment"]));if(!is_view($S)){foreach(array("Engine","Collation")as$y)json_row("$y-$C",h($S[$y]));foreach($Ih+array("Auto_increment"=>0,"Rows"=>0)as$y=>$X){if($S[$y]!=""){$X=format_number($S[$y]);json_row("$y-$C",($y=="Rows"&&$X&&$S["Engine"]==($vh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Ih[$y]))$Ih[$y]+=($S["Engine"]!="InnoDB"||$y!="Data_free"?$S[$y]:0);}elseif(array_key_exists($y,$S))json_row("$y-$C");}}}foreach($Ih
as$y=>$X)json_row("sum-$y",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$l=>$X){json_row("tables-$l",$X);json_row("size-$l",db_size($l));}json_row("");}exit;}else{$Rh=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Rh&&!$n&&!$_POST["search"]){$H=true;$Ke="";if($x=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$H=truncate_tables($_POST["tables"]);$Ke=lang(261);}elseif($_POST["move"]){$H=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Ke=lang(262);}elseif($_POST["copy"]){$H=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Ke=lang(263);}elseif($_POST["drop"]){if($_POST["views"])$H=drop_views($_POST["views"]);if($H&&$_POST["tables"])$H=drop_tables($_POST["tables"]);$Ke=lang(264);}elseif($x!="sql"){$H=($x=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Ke=lang(265);}elseif(!$_POST["tables"])$Ke=lang(9);elseif($H=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($J=$H->fetch_assoc())$Ke.="<b>".h($J["Table"])."</b>: ".h($J["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Ke,$H);}page_header(($_GET["ns"]==""?lang(38).": ".h(DB):lang(77).": ".h($_GET["ns"])),$n,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".lang(266)."</h3>\n";$Qh=tables_list();if(!$Qh)echo"<p class='message'>".lang(9)."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".lang(267)." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".lang(56)."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}$dc=doc_link(array('sql'=>'show-table-status.html'));echo"<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.lang(129),'<td>'.lang(268).doc_link(array('sql'=>'storage-engines.html')),'<td>'.lang(120).doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.lang(269).$dc,'<td>'.lang(270).$dc,'<td>'.lang(271).$dc,'<td>'.lang(51).doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.lang(272).$dc,(support("comment")?'<td>'.lang(50).$dc:''),"</thead>\n";$T=0;foreach($Qh
as$C=>$U){$Vi=($U!==null&&!preg_match('~table~i',$U));$t=h("Table-".$C);echo'<tr'.odd().'><td>'.checkbox(($Vi?"views[]":"tables[]"),$C,in_array($C,$Rh,true),"","","",$t),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($C)."' title='".lang(42)."' id='$t'>".h($C).'</a>':h($C));if($Vi){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($C).'" title="'.lang(43).'">'.(preg_match('~materialized~i',$U)?lang(127):lang(128)).'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($C).'" title="'.lang(41).'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",lang(44)),"Index_length"=>array("indexes",lang(131)),"Data_free"=>array("edit",lang(45)),"Auto_increment"=>array("auto_increment=1&create",lang(44)),"Rows"=>array("select",lang(41)),)as$y=>$_){$t=" id='$y-".h($C)."'";echo($_?"<td align='right'>".(support("table")||$y=="Rows"||(support("indexes")&&$y!="Data_length")?"<a href='".h(ME."$_[0]=").urlencode($C)."'$t title='$_[1]'>?</a>":"<span$t>?</span>"):"<td id='$y-".h($C)."'>");}$T++;}echo(support("comment")?"<td id='Comment-".h($C)."'>":"");}echo"<tr><td><th>".lang(245,count($Qh)),"<td>".h($x=="sql"?$g->result("SELECT @@storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$y)echo"<td align='right' id='sum-$y'>";echo"</table>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Pi="<input type='submit' value='".lang(273)."'> ".on_help("'VACUUM'");$tf="<input type='submit' name='optimize' value='".lang(274)."'> ".on_help($x=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".lang(124)." <span id='selected'></span></legend><div>".($x=="sqlite"?$Pi:($x=="pgsql"?$Pi.$tf:($x=="sql"?"<input type='submit' value='".lang(275)."'> ".on_help("'ANALYZE TABLE'").$tf."<input type='submit' name='check' value='".lang(276)."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".lang(277)."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".lang(278)."'> ".on_help($x=="sqlite"?"'DELETE'":"'TRUNCATE".($x=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".lang(125)."'>".on_help("'DROP TABLE'").confirm()."\n";$k=(support("scheme")?$b->schemas():$b->databases());if(count($k)!=1&&$x!="sqlite"){$l=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".lang(279).": ",($k?html_select("target",$k,$l):'<input name="target" value="'.h($l).'" autocapitalize="off">')," <input type='submit' name='move' value='".lang(280)."'>",(support("copy")?" <input type='submit' name='copy' value='".lang(281)."'>":""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $T);":"")." }"),"<input type='hidden' name='token' value='$ki'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.lang(74)."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.lang(202)."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".lang(141)."</h3>\n";$Tg=routines();if($Tg){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.lang(181).'<td>'.lang(49).'<td>'.lang(219)."<td></thead>\n";odd('');foreach($Tg
as$J){$C=($J["SPECIFIC_NAME"]==$J["ROUTINE_NAME"]?"":"&name=".urlencode($J["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.h($J["ROUTINE_NAME"]).'</a>','<td>'.h($J["ROUTINE_TYPE"]),'<td>'.h($J["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.lang(134)."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.lang(218).'</a>':'').'<a href="'.h(ME).'function=">'.lang(217)."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".lang(282)."</h3>\n";$hh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($hh){echo"<table cellspacing='0'>\n","<thead><tr><th>".lang(181)."</thead>\n";odd('');foreach($hh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".lang(224)."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".lang(26)."</h3>\n";$Ni=types();if($Ni){echo"<table cellspacing='0'>\n","<thead><tr><th>".lang(181)."</thead>\n";odd('');foreach($Ni
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".lang(228)."</a>\n";}if(support("event")){echo"<h3 id='events'>".lang(142)."</h3>\n";$K=get_rows("SHOW EVENTS");if($K){echo"<table cellspacing='0'>\n","<thead><tr><th>".lang(181)."<td>".lang(283)."<td>".lang(208)."<td>".lang(209)."<td></thead>\n";foreach($K
as$J){echo"<tr>","<th>".h($J["Name"]),"<td>".($J["Execute at"]?lang(284)."<td>".$J["Execute at"]:lang(210)." ".$J["Interval value"]." ".$J["Interval field"]."<td>$J[Starts]"),"<td>$J[Ends]",'<td><a href="'.h(ME).'event='.urlencode($J["Name"]).'">'.lang(134).'</a>';}echo"</table>\n";$Ac=$g->result("SELECT @@event_scheduler");if($Ac&&$Ac!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Ac)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.lang(207)."</a>\n";}if($Qh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();