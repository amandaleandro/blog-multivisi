<?php

class Event{
    private $Dado,
            $Result;

    const tb_event = 'events',
          tb_event_photos = 'events_photos';


    function __construct($Dado){
        $this->Dado = $Dado;
        $this->actionData($Dado);
    }

    public function getResult(){ return $this->Result; }

    private function actionData($data) {
        switch($data['action']){
            case 'create_event':
                unset($this->Dado['action']);
                $this->Result = $this->createEvent();
            break; 
            case 'update_event':
                unset($this->Dado['action']);
                $this->Result = $this->updateEvent();
            break;      
            case 'delete_event':
                unset($this->Dado['action']);
                $this->Result = $this->deleteEvent();
            break;    
        }
    }

    private function createEvent(){
        $read = new Read();
        $read->ExeRead(self::tb_event, 'WHERE event_title = :n', "n={$this->Dado['event_title']}");
        if($read->getResult()){
            return ['Name aredy exist', WS_ERROR];
        }else{


            
            if(isset($_FILES['event_cover']) && !$_FILES['event_cover']['error']){
               $this->Dado['event_cover'] = createSizesImage($_FILES['event_cover'], 'event');
            }else{
               return ['Imagen muito grande!'];
            }

            if(isset($_FILES['event_photos']) && $this->Dado['event_branch'] == 1){
                $listphotos = null;
               
                for($i = 0; $i < count($_FILES['event_photos']['name']); $i++){
                    $x = [
                        'name' => $_FILES['event_photos']['name'][$i],
                        'type' => $_FILES['event_photos']['type'][$i],
                        'tmp_name' => $_FILES['event_photos']['tmp_name'][$i],
                        'error' => $_FILES['event_photos']['error'][$i],
                        'size' => $_FILES['event_photos']['size'][$i],
                    ];
            
                    $listphotos .= createSizesImage($x, 'event') . ',';
                }
                    
                $this->Dado['event_photos'] = substr($listphotos, 0, strlen($listphotos) -1);
            }

           $create = new Create();
           $create->ExeCreate(self::tb_event, $this->Dado);
           if($create->getResult()){
               return ['Created successful', WS_ACCEPT];
            }
        }
    }

    private function updateEvent(){
        $read = new Read();
        $read->ExeRead(self::tb_event, 'WHERE event_title = :u AND event_id != :i', "u={$this->Dado['event_title']}&i={$this->Dado['event_id']}");
        if($read->getRowCount()){
           ExDebug('error');
        }else{
            $read->ExeRead(self::tb_event, 'WHERE event_id = :i', "i={$this->Dado['event_id']}");
            if($read->getResult()){
                $this->Dado['event_cover'] = $read->getResult()[0]['event_cover'];
                
                if(isset($_FILES['event_cover']) && !$_FILES['event_cover']['error']){
                    unlink('../../public/img/upload/' . $this->Dado['event_cover']);
                    $this->Dado['event_cover'] = createSizesImage($_FILES['event_cover'], 'event');
                }

                if(empty($this->Dado['event_photos'])){
                    $this->Dado['event_photos'] = null;
                }

                if(isset($_FILES['event_photos'])){
                    $listphotos = ',';
                   
                    for($i = 0; $i < count($_FILES['event_photos']['name']); $i++){
                        $x = [
                            'name' => $_FILES['event_photos']['name'][$i],
                            'type' => $_FILES['event_photos']['type'][$i],
                            'tmp_name' => $_FILES['event_photos']['tmp_name'][$i],
                            'error' => $_FILES['event_photos']['error'][$i],
                            'size' => $_FILES['event_photos']['size'][$i],
                        ];
                
                        $listphotos .= createSizesImage($x, 'event') . ',';
                    }
                    $this->Dado['event_photos'] .=  $listphotos;
                }
                
               
                $update = new Update();
                $update->ExeUpdate(self::tb_event, $this->Dado, 'WHERE event_id = :i', "i={$this->Dado['event_id']}");
                if($update->getResult()){
                   return ['Update Successful', WS_ACCEPT];
                }
            }
        }
    }

    private function deleteEvent(){
        if(empty($this->Dado['event_id']) && !is_numeric($this->Dado['event_id'])){
            return ['Erro', WS_ERROR];
        }else{
            $read = new Read();
            $delete = new Delete();
            $read->ExeRead(self::tb_event, 'WHERE event_id = :id', "id={$this->Dado['event_id']}");
            if(!$read->getResult()){
                return ['Any product found!', WS_INFO];
            }else{ 
                $delete->ExeDelete(self::tb_event, 'WHERE event_id = :id', "id={$this->Dado['event_id']}");
                if(!$delete->getResult()){
                    return ['erro', WS_ERROR];
                }else{
                    return ['File deleted!', WS_ACCEPT];
                }
            }
        }
    }

    private function Pagination(){
        $read = new Read();
        $page = (is_numeric($this->Dado['num']) ? (int) $this->Dado['num'] : 0);
        $max = 10;
        $links = 8;
        $start = ( ($max * $page ) - $max);

        if($page > 0){
            $read->ExeRead(self::tb_event, "order by event_id DESC LIMIT {$start}, {$max}");
            if($read->getResult()){
                $registers = $read->getResult();

                $read->ExeRead(self::tb_event);
                if($read->getResult()){
                    $count_links = $read->getRowCount();
                    $count_total = ceil($count_links / $max);

                    return [
                        'reg'         => $registers,
                        'reg_total'   => $count_links,
                        'page_active' => $page,
                        'max_links'   => $links,
                        'pag_total'   => $count_total,
                        'limit'       => $max
                     ];
                }
            }
        }
    }
}