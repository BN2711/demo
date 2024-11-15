<?php
if(!defined('_CODE')){
    die('Access denied...');
}

function query($sql, $data=[], $check = flase){
    global $conn;
    $ketqua = false;
    try{
        $statement = $conn -> prepare($sql);
        if(!empty($data)){
           $ketqua = $statement -> execute($data);
        }
        else{
           $ketqua = $statement -> execute();
        }
    }catch(Exception $exp){
        echo $exp -> getMessage().'<br>';
        echo 'File'. $exp -> getFile().'<br>';
        echo 'Line'. $exp -> getLine();
        die();
    }
    if($check){
        return $statement;
    }
    return $ketqua;
}
// hàm insert vào data
function insert($table, $data) {
    $key = array_keys($data);
    $truong = implode(',', $key);
    $valuetb = ':' . implode(',:', $key); 
    $sql = 'INSERT INTO ' . $table . ' (' . $truong . ') VALUES (' . $valuetb . ')';

    $kq = query($sql, $data);
    return $kq;
}
// hàm update 
function update($table, $data, $condition=''){
    $update ='';
    foreach($data as $key => $value){
        $update .= $key . '= :' . $key .',';
    }
    $update = trim($update,',');
    if(!empty($condition)){
        $sql = 'UPDATE' . $table . 'SET' . $update .' WHERE '. $condition;
    }else{
        $sql = 'UPDATE' . $table . 'SET' . $update;
    }
    $kq = query($sql, $data);
    return $kq;
}
// hàm delete
function delete($table, $condition=''){
    if(empty($condition)){
        $sql = 'DELETE FROM' .$table;
    }
    else{
        $sql = 'DELETE FROM' .$table . ' WHERE ' . $conditon;
    }
    $kq = query($sql);
    return $kq;
}
// lấy nhiều dữ dòng dữ liệu
function getRaw ($sql){
    $kq = query($sql,'',true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}
// lấy 1 dòng đữ liệu
function oneRaw ($sql){
    $kq = query($sql,'',true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}