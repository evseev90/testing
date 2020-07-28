<?php


class GeneratorShuffle
{

    private $_indexes = [];
    private $_inArray = [];
    private $_countArray = null;
    private $_curIndex = null;

    function getCurrentIndex()
    {
        $curIndex = false;

        $maxValueForIndex = $this->_countArray - 1;
        $maxIndex = count($this->_indexes) - 1;

        for ($i = $maxIndex; $i >= 0; $i--) {
            if ($this->_indexes[$i] < $maxValueForIndex - ($maxIndex - $i)) {
                $curIndex = $i;
                break;
            }
        }

        return $curIndex;
    }

    function updateIndexes(): bool
    {

        $maxValueForIndex = $this->_countArray - count($this->_indexes) + $this->_curIndex;

        $this->_indexes[$this->_curIndex]++;

        if ($this->_indexes[$this->_curIndex] > $maxValueForIndex) {
            if (!isset($this->_indexes[$this->_curIndex - 1])) {
                return false;
            }

            $this->_indexes[$this->_curIndex - 1]++;
            do {
                for ($start = $this->_curIndex; $start < count($this->_indexes); $start++) {
                    $this->_indexes[$start] = $this->_indexes[$start - 1] + 1;
                }
            } while ($this->_indexes[$this->_curIndex - 1] >= $maxValueForIndex) ;

            $this->_curIndex = $this->getCurrentIndex();

        }

        return $this->_curIndex >= 0;
    }

    function takeShuffle($indexes): array
    {
        $shuffleArray = [];
        echo '[' . join(',', $indexes) . ']' . PHP_EOL;
        foreach ($indexes as $index) {
            $shuffleArray[] = $this->_inArray[$index];
        }
        return $shuffleArray;
    }

    function getSlots($length)
    {
        $this->_indexes = [];
        for ($i = 0; $i < $length; $i++) {
            $this->_indexes[] = $i;
        }
        $this->_curIndex = $length - 1;

        do {
            yield $this->takeShuffle($this->_indexes);

        } while ($this->updateIndexes());
    }

    function generate(array $inArray): array
    {
        $this->_inArray = $inArray;
        $this->_countArray = count($this->_inArray);

        $resultArray = [];
        for ($i = 1; $i <= 4; $i++) {
            foreach ($this->getSlots($i) as $iter) {
                $resultArray[] = $iter;
            }
        }

        return $resultArray;
    }
}


$gen = new GeneratorShuffle();
$out = $gen->generate(['1', '2', '3', '4', '5', '6']);

foreach ($out as $item) {
    echo join(',', $item), PHP_EOL;
}
