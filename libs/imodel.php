<?
    interface IModel{
        public function sabe();
        public function getAll();
        public function get($id);
        public function delete($id);
        public function update();
        public function from($array);
    }
?>