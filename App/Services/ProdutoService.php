<?php
    namespace App\Services;

    use App\Models\Produto;

    class ProdutoService
    {
        public function get($id = null) 
        {
            if ($id) {

                return Produto::select($id);
            } else {
                return Produto::selectAll();
            }
        }

        public function post($update = null) 
        {
            $data = $_POST;
            if($update){
                return Produto::update($data);
            }else{
                return Produto::insert($data);
            }
        }

        public function delete($id = null) 
        {
            return Produto::delete($id);

        }
    }