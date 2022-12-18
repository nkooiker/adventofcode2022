<?php

$input = file_get_contents('input7');
$input_array = explode(PHP_EOL, $input);

class InfoSingleton {
    private static $instance = null;
    public int $size;
    public int $sizeNeeded;
    public int $smallestPossibleDirectorySize;

    private function __construct() {
        $this->size = 0;
        $this->sizeNeeded = PHP_INT_MAX;
        $this->smallestPossibleDirectorySize = PHP_INT_MAX;
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new InfoSingleton();
        }

        return self::$instance;
    }

    public function trySize(int $size) {
        if ($size >= $this->sizeNeeded && $size < $this->smallestPossibleDirectorySize) {
            $this->smallestPossibleDirectorySize = $size;
            echo 'Found candidate with size: '. $size.PHP_EOL;
        }
        // echo 'tried '.$this->sizeNeeded.'-'.$this->smallestPossibleDirectorySize.'-'.$size;
    }
}

class Node {
    public $name;
    public $parent;
    protected int $size;

    public function __construct($newParent, $newName) {
        $this->parent = $newParent;
        $this->name = $newName;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize(int $newSize) {
        $this->size = $newSize;
    }
}

class DirectoryNode extends Node {
    protected $nodes;

    public function __construct($newParent, $newName) {
        parent::__construct($newParent, $newName);
        $this->nodes = array();        
    }

    public function add($node) {
        array_push($this->nodes, $node);
    }

    public function getSize() {
        $totalSize = 0;
        foreach($this->nodes as $node) {
            $totalSize += $node->getSize();
        }
        if ($totalSize <= 100000) InfoSingleton::getInstance()->size += $totalSize;
        InfoSingleton::getInstance()->trySize($totalSize);
        return $totalSize;
    }
}

$root;
$current;
$depth = 0;

foreach($input_array as $value) {
    echo $value.PHP_EOL;
    if (str_starts_with($value, '$ cd')) {
        //cd
        $name = explode(' ', $value)[2];
        if ($name == '/') {
            //create root
            $root = new DirectoryNode(null, $name);
            $current = $root;
        } else if ($name == '..') {
            $current = $current->parent;
            $depth--;
        } else {
            $newDirectory = new DirectoryNode($current, $name);
            $current->add($newDirectory);
            $current = $newDirectory;
            $depth++;
            echo str_repeat("-", $depth).$name.PHP_EOL;
        }

    } else if (str_starts_with($value, '$ ls')) {
        //ls
    } else if (str_starts_with($value, 'dir')) {
        //dir
    } else {
        //file
        $arguments = explode(' ', $value);
        $size = (int)$arguments[0];
        $name = $arguments[1];
        $file = new Node($current, $name);
        $file->setSize($size);
        $current->add($file);
    }
}

$totalSize = $root->getSize();
echo InfoSingleton::getInstance()->size.PHP_EOL; // Answer part 1

$freeSpace = (70000000-$totalSize);
$spaceNeeded = (30000000-(70000000-$totalSize));
echo 'space used: '.$totalSize.' free space: '.$freeSpace.' space needed: '.$spaceNeeded.PHP_EOL;
InfoSingleton::getInstance()->sizeNeeded = $spaceNeeded;
$totalSize = $root->getSize();
echo 'Found directory with size: '.InfoSingleton::getInstance()->smallestPossibleDirectorySize.PHP_EOL; // Answer part 2

?>