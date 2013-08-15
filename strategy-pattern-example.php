<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);

/*
 * The Strategy Design Pattern helps architect an object that can make use of 
 * algorithms in other objects on demand in lieu of containing the logic itself.
 */
class CDusesStrategy
{
    /**
     * CD Title
     * @var string
     */
    private $title;
    
    /**
     * The Music Band
     * @var string
     */
    private $band;
    
    /*
     * The Object of different type ie. Array, Json or XML which been chosed on demand
     * @var object
     */
    protected $_strategy;
    
    public function __construct($title, $band) {
        $this->title = $title;
        $this->band = $band;
    }
    /**
     * Returns CD's Title
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
    
    /**
     * Returns CD's Band
     * @return string
     */
    public function getBand() {
        return $this->band;
    }
    
    /**
     * Sets Object of type Arrary or JSON or XML
     *
     */
    public function setStrategry($st) {
        $this->_strategy = $st;
    }
    
     /**
     * Gets Object of type Arrary or JSON or XML
     * @param object
     */
    public function get() {
        return $this->_strategy->get($this);
    }
}

class CDasArray
{
    public function get(CDusesStrategy $cd)
    {
        $cd = array(
            'CD' => array(
                'Title' => $cd->getTitle(),
                'Band' => $cd->getBand()
            )
        );
        
        return $cd;
    }
}

class CDasXMLStrategy
{
    public function get(CDusesStrategy $cd) {
        $doc = new DOMDocument();
        $root = $doc->createElement('CD');
        $root = $doc->appendChild($root);
        $title = $doc->createElement('Title', $cd->getTitle());
        $title = $root->appendChild($title);
        $band = $doc->createElement('Band', $cd->getBand());
        $band = $root->appendChild($band);
        
        return $doc->saveXML();
    }
}

class CDasJSONStrategy
{
    public function get(CDusesStrategy $cd) {
        $json = array();
        $json['CD']['title'] = $cd->getTitle();
        $json['CD']['band'] = $cd->getBand();
        
        return json_encode($json);
    }
}

//Actual Strategy Implementation
$mycd = new CDusesStrategy('Chekyoo Chekyoo', 'Nepathya');

//xml output
$mycd->setStrategry(new CDasXMLStrategy());
echo '<pre>'; print_r($mycd->get()); echo '</pre>';

//json output
$mycd->setStrategry(new CDasJSONStrategy());
echo '<pre>'; print_r($mycd->get()); echo '</pre>';

//array output
$mycd->setStrategry(new CDasArray());
echo '<pre>'; print_r($mycd->get()); echo '</pre>';
?>
