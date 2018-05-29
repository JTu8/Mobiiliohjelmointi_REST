<?php

    class Push {

        private $title;
        private $message;
        private $image;
        private $data;
        private $is_backround;

        function _construct() {


        }

        public function setTitle($title) {

            $this->title = $title;
        }

        public function setMessage($message) {
            
            $this->message = $message;
        }
        
        public function setImage($imageUrl) {

            $this->image = $imageUrl;
        }

        public function setPayload($data) {

            $this->data = $data;
        }
        
        public function setIsBackround($is_backround) {
            
            $this->is_backround = $is_backround;
        }

        public function getPush() {

            $res = array();
            $res['data']['title'] = $this->title;
            $res['data']['is_backround'] = $this->is_backround;
            $res['data']['message'] = $this->message;
            $res['data']['image'] = $this->image;
            $res['data']['payload'] = $this->data;
            $res['data']['timestamp'] = $this->date('Y-m-d G:i:s');
            return $res;
        }



    }
?>