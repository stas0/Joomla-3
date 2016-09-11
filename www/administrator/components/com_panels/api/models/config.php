<?php
    namespace NSPanels;

    class PanelsConfig{
        private $select = array();
        private $ids = array();

        /**
         * @return array
         */
        public function getIds()
        {
            if(count($this->ids) == 0){
                return '';
            }

            array_unique($this->ids);

            $res = join(', ', $this->ids);

            return rtrim($res, ', ');
        }

        /**
         * @param array $ids
         */
        public function setIds($id)
        {
            array_push($this->ids, $id);
        }

        /**
         * @return array
         */
        public function getSelect()
        {
            if(count($this->select) == 0){
                return '*';
            }

            array_unique($this->select);
            
            $res = join(', ', $this->select);
            
            return rtrim($res, ', ');
        }

        /**
         * @param array $select
         */
        public function setSelect($select)
        {
            array_push($this->select, $select);
        }
    }
?>