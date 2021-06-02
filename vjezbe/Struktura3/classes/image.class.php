<?php 

    class Image {

        private $imagePath;

        /**
         * if global $_FILES[$key] is not set, return the key
         * if file is uploaded get filename
         * if file already exists add random number between 100 and 999 to filename
         * save file to images and return file path
         *
         * @param [string] $key
         * @return string
         */
        public function __construct($key) {
            if(!isset($_FILES[$key])) {
                $this->imagePath = $key;
                return;
            }
            if($_FILES[$key]['error'] != 4) {

                $fileName = $_FILES[$key]['name'];
                $path = file_exists('../images/' . $fileName) ? 'images/' . mt_rand(100, 999) . $fileName : 'images/' . $fileName;
                $optionImage = $_FILES[$key]['error'] == 4 ? '' : explode('/', $path)[1];

                if($optionImage) {
                    move_uploaded_file($_FILES[$key]['tmp_name'], '../' . $path);
                }
                
                $this->imagePath = $optionImage;
            } else {
                $this->imagePath = '';
            }
        }
        public function getImage() {
            return $this->imagePath;
        }
    }

?>