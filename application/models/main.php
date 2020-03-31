<?php

class Model {
    public function __construct() {
	$this->mongo= new MongoDB();
    }
    
    protected function secure($type,$data,$min=null,$max=null) {
	
	if ($min==null) { $min=0; } $error = $type.': invalid data';

	if (mb_strlen($data)!==0) {

	    if ($type=='string') { $output= (string) $data; }
	    elseif ($type=='word') { if ($max>2048 or $max==null) { $max=2048; } $r='/[^\p{Latin}]/ui'; $check = $data; $data = preg_replace($r,'',(string)$data); if (mb_strlen($check)!==mb_strlen($data)) { echo $error; die; } $output = $data; }
	    elseif ($type=='number') { $r='/[^0-9]/ui'; $check = $data; $data = preg_replace($r,'',(string)$data); if (mb_strlen($check)!==mb_strlen($data) or mb_strlen($data)>65) { echo $error; die; } $output = (int) $data; }
	    elseif ($type=='phone') { if ($max>19 or $max==null) { $max=19; } $data = preg_split('//u',$data,-1,PREG_SPLIT_NO_EMPTY); $p = ['0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','N'=>'0','n'=>'0','O'=>'0','o'=>'0','U'=>'0','u'=>'0','V'=>'0','v'=>'0','P'=>'9','p'=>'9','Q'=>'0','q'=>'9','R'=>'9','r'=>'7','S'=>'5','s'=>'5','T'=>'0','t'=>'9','J'=>'9','j'=>'9','M'=>'0','m'=>'0','Z'=>'2','z'=>'2','G'=>'6','g'=>'9','H'=>'0','h'=>'6','I'=>'1','i'=>'1','W'=>'0','w'=>'0','K'=>'0','k'=>'0','L'=>'7','l'=>'1','A'=>'14','a'=>'0','B'=>'8','b'=>'6','C'=>'0','c'=>'0','D'=>'0','d'=>'6','E'=>'9','e'=>'9','F'=>'9','f'=>'7','X'=>'0','x'=>'0','Y'=>'9','y'=>'9','а'=>'6','А'=>'14','б'=>'6','Б'=>'6','в'=>'8','В'=>'8','г'=>'7','Г'=>'7','д'=>'0','Д'=>'0','ж'=>'0','Ж'=>'0','з'=>'3','З'=>'3','е'=>'9','Е'=>'9','ё'=>'9','Ё'=>'9','и'=>'0','И'=>'0','й'=>'0','Й'=>'0','к'=>'0','К'=>'0','л'=>'0','Л'=>'0','м'=>'0','М'=>'0','н'=>'0','Н'=>'0','о'=>'0','О'=>'0','п'=>'0','П'=>'0','р'=>'9','Р'=>'9','с'=>'0','С'=>'0','т'=>'0','Т'=>'0','у'=>'9','У'=>'9','ф'=>'0','Ф'=>'0','х'=>'0','Х'=>'0','ц'=>'0','Ц'=>'0','ч'=>'9','Ч'=>'9','ш'=>'0','Ш'=>'0','щ'=>'0','Щ'=>'0','ь'=>'6','Ь'=>'6','ъ'=>'6','Ъ'=>'6','ы'=>'61','Ы'=>'61','э'=>'9','Э'=>'9','ю'=>'10','Ю'=>'10','я'=>'19','Я'=>'19','/'=>'1','|'=>'1','&'=>'8','\\'=>'1','$'=>'5','#'=>'#','*'=>'*','@'=>'0','!'=>'1','<'=>'6','>'=>'9','?'=>'7','%'=>'0',':'=>'1',';'=>'1','+'=>'+']; $c = count($data); for ($i=0;$c>$i;$i++) { $z = $data[$i]; $data[$i] = $p[$z]; } $data=implode('', $data); if (substr($data,0,3)=='380' and mb_strlen($data)==12) { $data = '+'.$data; } elseif (substr($data,0,3)=='80' and mb_strlen($data)==11) { $data = '+3'.$data; } elseif (substr($data,0,1)=='0' and mb_strlen($data)==10) { $data = '+38'.$data; } $r='/[^0-9\+\*\#\p{Latin}]/ui'; $data = preg_replace($r,'',(string)$data); if (preg_match('/\+\+/',$data)) { echo $error; die; } $output = $data; }
	    elseif ($type=='date') { $r='/[^0-9\:\,\.\ \/\+\-]/ui'; $data = preg_replace($r,'',(string)$data); $fdate=0; $ftime=0; $try = explode(',',$data); for ($i=0;count($try)>$i;$i++) { $try[$i] = explode(' ',$try[$i]); for ($z=0;count($try[$i])>$z;$z++) { if ($ftime==0 and (mb_strlen($try[$i][$z])==5 or mb_strlen($try[$i][$z])==8)) { $time=str_replace('-',':',str_replace('.',':',$try[$i][$z])); $time = explode(':',$time); if ((count($time)==2 or (count($time)==3 and ((int)$time['2']>=0 and 60>(int)$time['2'] and mb_strlen($time['2'])==2))) and ((int)$time['0']>=0 and 24>(int)$time['0'] and mb_strlen($time['0'])==2) and ((int)$time['1']>=0 and 60>(int)$time['1'] and mb_strlen($time['1'])==2)) { $ftime=1; } if ($ftime==1) { $time = str_pad($time['0'],2,'0',STR_PAD_RIGHT).':'.str_pad($time['1'],2,'0',STR_PAD_RIGHT).':'.str_pad($time['2'],2,'0',STR_PAD_RIGHT); } else { unset($time); } } if ($fdate==0 and mb_strlen($try[$i][$z])==10) { $date=str_replace('.','-',str_replace('/','-',$try[$i][$z])); $date = explode('-',$date); if (count($date)==3) { if (((int)$date>0 and mb_strlen($date['0'])>=4) and ((int)$date['1']>=1 and 12>=(int)$date['1'] and mb_strlen($date['1'])==2) and ((int)$date['2']>=1 and 31>=(int)$date['2'] and mb_strlen($date['2'])==2)) { $fdate=1; $date = str_pad($date['0'],4,'0',STR_PAD_RIGHT).'-'.str_pad($date['1'],2,'0',STR_PAD_RIGHT).'-'.str_pad($date['2'],2,'0',STR_PAD_RIGHT); } elseif (((int)$date['0']>=1 and 31>=(int)$date['0'] and mb_strlen($date['0'])==2) and ((int)$date['1']>=1 and 12>=(int)$date['1'] and mb_strlen($date['1'])==2) and ((int)$date['2']!==0 and mb_strlen($date['2'])>=4)) { $fdate=1; $date = str_pad($date['2'],4,'0',STR_PAD_RIGHT).'-'.str_pad($date['1'],2,'0',STR_PAD_RIGHT).'-'.str_pad($date['0'],2,'0',STR_PAD_RIGHT); } } if ($fdate!==1) { unset($date); } } } } if ($fdate==1 and $ftime==1) { $output = $date.' '.$time; } elseif ($fdate==1) { $output = $date; } elseif ($ftime==1) { $output = $time; } elseif ($fdate==0 and $ftime==0) { echo $error; die; } }
	    elseif ($type=='token') { $r='/[^0-9\p{Latin}]/ui'; $check = $data; $data = preg_replace($r,'',(string)$data); if (mb_strlen($check)!==mb_strlen($data)) { echo $error; die; } $output = $data; }
	    elseif ($type=='email') { if ($max>2048 or $max==null) { $max=2048; } $r='/[^0-9\-\.\@\p{Latin}]/ui'; $check = $data; $data = preg_replace($r,'',(string)$data); if (mb_strlen($check)!==mb_strlen($data)) { echo $error; die; } $data = explode('@',$data); $check=1; if (count($data)!==2) { echo $error; die; } if (!preg_match('/\./',$data['1']) or mb_substr($data['1'],0,1)=='.' or mb_substr($data['1'],0,1)=='-' or mb_substr($data['1'],-1)=='.' or mb_substr($data['1'],-1)=='-' or 3>mb_strlen($data['1'])) { $check=0; } if (mb_substr($data['0'],0,1)=='.' or mb_substr($data['0'],0,1)=='-' or mb_substr($data['0'],-1)=='.' or mb_substr($data['0'],-1)=='-' or 1>mb_strlen($data['0'])) { $check=0; } if ($check!==1) { echo $error; die; } $data = implode('@',$data); $output = $data; }
	    $output = htmlentities(str_replace('--','—',(string)$output),ENT_QUOTES,'UTF-8'); if (($max!==null and mb_strlen($output)>$max) or $min>mb_strlen($output)) { echo $error; die; }

	}

	return $output;
    }
    
    public function create() {

	$data = $_POST['data'];
	$name = $this->secure('word',$data['0'],2,1000);
	$surename = $this->secure('word',$data['1'],2,1000);
	$date = date('d-m-Y',strtotime($this->secure('date',$data['2'],2,2048)));
	$phone = $this->secure('phone',$data['3'],10,19);
	$email = $this->secure('email',$data['4'],5,2048);

	if (mb_strlen($name)==0) { echo 'word: invalid data'; die; }
	if (mb_strlen($surename)==0) { echo 'word: invalid data'; die; }
	if (mb_strlen($date)==0) { echo 'date: invalid data'; die; }
	if (mb_strlen($phone)==0) { echo 'phone: invalid data'; die; }
	if (mb_strlen($email)==0) { echo 'email: invalid data'; die; }

	$user = ['name'=>$name,'surename'=>$surename,'date'=>$date,'phone'=>$phone,'email'=>$email];
	$this->mongo->insert('test','users',$user);
	
	echo 'success';
    }
    
    public function read() {

	$output = $this->mongo->select('test','users');
	$output = json_decode(json_encode($output),true);
	for ($i=0;count($output)>$i;$i++) { $output[$i]['id']=$output[$i]['_id']['$oid']; unset($output[$i]['_id']); }

	print_r(json_encode($output));
    }
    
    public function update() {
	
	$data = $_POST['data'];
	$id = $this->secure('token',$_POST['id'],1,2048);
	$name = $this->secure('word',$data['0'],2,1000);
	$surename = $this->secure('word',$data['1'],2,1000);
	$date = date('d-m-Y',strtotime($this->secure('date',$data['2'],2,2048)));
	$phone = $this->secure('phone',$data['3'],10,19);
	$email = $this->secure('email',$data['4'],5,2048);

	if (mb_strlen($name)==0) { echo 'word: invalid data'; die; }
	if (mb_strlen($surename)==0) { echo 'word: invalid data'; die; }
	if (mb_strlen($date)==0) { echo 'date: invalid data'; die; }
	if (mb_strlen($phone)==0) { echo 'phone: invalid data'; die; }
	if (mb_strlen($email)==0) { echo 'email: invalid data'; die; }
	
	$user = ['name'=>$name,'surename'=>$surename,'date'=>$date,'phone'=>$phone,'email'=>$email]; $where = ['_id'=>$id]; $paging = ['limit'=>1];
	$this->mongo->update('test','users',$user,$where,$paging);
	
	echo 'success';
    }

    public function delete() {
	
	$id = $this->secure('token',$_POST['id'],1,2048);
	$this->mongo->delete('test','users',['_id'=>$id]);

	echo 'success';
	
    }    
}

?>