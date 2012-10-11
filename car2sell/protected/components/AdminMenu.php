class AdminMenu extends CWidget {
    public function run() {
        $types = Types::model()->findAll();
         
        $this->render('admin_menu',array('types'=>$types));
    }
}