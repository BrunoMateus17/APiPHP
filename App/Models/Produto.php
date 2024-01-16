<?php
    namespace App\Models;

    use Conexao;

    include_once "Conexao.php";

    

    class Produto
    {
        private static $table = 'produto';

        public static function select(int $id) {
            $conn = Conexao::conectar();
            $sql = '
                SELECT 
                * 
                FROM 
                    '.self::$table.' 
                WHERE 
                    id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }

        public static function selectAll() {
            $conn = Conexao::conectar();
            $sql = '
                SELECT 
                    * 
                FROM 
                    '.self::$table;
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }

        public static function insert($data)
        {
            $conn = Conexao::conectar();
            $sql = 'INSERT INTO 
                '.self::$table.' 
                (
                    CD_produto, 
                    nome, 
                    valor,
                    descricao,
                    quantidade
                )
                 VALUES 
                (
                    :cd, 
                    :no, 
                    :va, 
                    :de, 
                    :qu
                )';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cd', $data['CD_produto']);
            $stmt->bindValue(':no', $data['nome']);
            $stmt->bindValue(':va', $data['valor']);
            $stmt->bindValue(':de', $data['descricao']);
            $stmt->bindValue(':qu', $data['quantidade']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }
        public static function update($data)
        {
            $conn = Conexao::conectar();
            $sql = 
                'UPDATE '.
                    self::$table.'  
                SET 
                    CD_produto = :cd, 
                    nome = :no, 
                    valor = :va,
                    descricao = :de,
                    quantidade = :qu 
                WHERE 
                    id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cd', $data['CD_produto']);
            $stmt->bindValue(':no', $data['nome']);
            $stmt->bindValue(':va', $data['valor']);
            $stmt->bindValue(':de', $data['descricao']);
            $stmt->bindValue(':qu', $data['quantidade']);
            $stmt->bindValue(':id', $data['id']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) alterado com sucesso!';
            } else {
                throw new \Exception(json_encode($data));
            }
        }

        public static function delete($id)
        {
            $conn = Conexao::conectar();

            $sql = 'DELETE 
                    FROM 
                        '.self::$table.' 
                    WHERE 
                        id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
    
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Usuário(a) deletado com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }
    }