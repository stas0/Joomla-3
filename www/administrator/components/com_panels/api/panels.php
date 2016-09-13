<?php
    require_once 'models/config.php';

    use NSPanels as NSPanels;

    class Panels{
        /**
         * Get panels
         *
         * @param null $config \NSPanels\PanelsConfig - config class
         * @return mixed
         */
        public function getPanels($config = null){
            if(is_null($config)){
                $config = new \NSPanels\PanelsConfig();
            }

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->select($config->getSelect());
            $query->from('#__panels_panels');

                // Ids
            $ids = $config->getIds();

            if($ids != ''){
                $query->where('id in('. $ids .')');
            }

                //  Publish state = 1
            $query->where('publish = 1');

            $db->setQuery($query);

            $res = $db->loadObjectList();

            return $res;
        }

        public function getPanel($id, $config = null){
            if(is_null($config)){
                $config = new \NSPanels\PanelsConfig();
            }

            $config->setIds($id);

            $res = $this->getPanels($config);

            return $res[0];
        }

        /**
         * Get panel style
         *
         * @param $panelId - parent panel ID
         * @param null $config \NSPanels\PanelsConfig - config class
         * @return mixed
         */
        public function getPanelStyles($panelId, $config = null){
            if(is_null($config)){
                $config = new \NSPanels\PanelsConfig();
            }

            $db = JFactory::getDbo();

            $query = $db->getQuery(true);
            $query->select($config->getSelect());
            $query->from('#__panel_styles');
            $query->where('panel = ' . $panelId);

            $db->setQuery($query);

            $res = $db->loadObjectList();

            return $res;
        }
    }
?>