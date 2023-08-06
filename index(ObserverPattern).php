<?php
// Observer interface
interface Observer {
    public function update($data_id, $data_nama, $data_user, $data_level);
}

// Subject class
class Subject {
    private $observers = array();
    private $data_id;
    private $data_nama;
    private $data_user;
    private $data_level;
    
    public function attach(Observer $observer){
        $this->observers[] = $observer;
    }
    
    public function detach(Observer $observer){
        $index = array_search($observer, $this->observers);
        if($index !== false){
            unset($this->observers[$index]);
        }
    }
    
    public function notify(){
        foreach($this->observers as $observer){
            $observer->update($this->data_id, $this->data_nama, $this->data_user, $this->data_level);
        }
    }
    
    public function setData($data_id, $data_nama, $data_user, $data_level){
        $this->data_id = $data_id;
        $this->data_nama = $data_nama;
        $this->data_user = $data_user;
        $this->data_level = $data_level;
        $this->notify();
    }
}

// Concrete Observer class
class ConcreteObserver implements Observer {
    public function update($data_id, $data_nama, $data_user, $data_level){
        echo "Data updated:\n";
        echo "data_id: $data_id\n";
        echo "data_nama: $data_nama\n";
        echo "data_user: $data_user\n";
        echo "data_level: $data_level\n";
    }
}

// Create subject instance
$subject = new Subject();

// Create observer instance
$observer = new ConcreteObserver();

// Attach the observer to the subject
$subject->attach($observer);

// Set data on the subject
$data_id = 1;
$data_nama = "John Doe";
$data_user = "john.doe";
$data_level = "Administrator";
$subject->setData($data_id, $data_nama, $data_user, $data_level);
?>
