<?php
class Curso
{
    private static $conn;
    
    public static function getConnection()
    {
        if (empty(self::$conn))
        {
            $ini = parse_ini_file('config/plataforma.ini');
            $host = $ini['host'];
            $name = $ini['name'];
            $user = $ini['user'];
            $pass = $ini['pass'];
            
            self::$conn = new PDO("mysql:host={$host};dbname={$name}","{$user}","{$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
    
    public static function find($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("SELECT * FROM curso WHERE id=:id");
        $result->execute( [ ':id' => $id ]);
        return $result->fetch();
    }
    
    public static function delete($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("DELETE FROM curso WHERE id=:id");
        $result->execute( [ ':id' => $id ]);
    }
    
    public static function all()
    {
        $conn = self::getConnection();


     
        $result = $conn->query("SELECT * FROM curso");
        
       
        return $result->fetchAll();
    }
    
    public static function save($curso)
    {
        $conn = self::getConnection();
        
        if (empty($curso['id']))
        {
            
            
            $sql = "INSERT INTO curso (id, titulo, descricao, imagem, link)
                                VALUES ( :id, :titulo, :descricao, :imagem, :link)";
        }
        else
        {
            $sql = "UPDATE curso SET id  = :id,
                                  titulo  = :titulo,
                                  descricao  = :descricao,
                                  imagem  = :imagem,
                                  link    = :link
                        WHERE id = :id";
        }
        
        $result = $conn->prepare($sql);
        $result->execute( [ ':id'   => $curso['id'],
                            ':titulo'   => $curso['titulo'],
                            ':descricao'   => $curso['descricao'],
                            ':imagem'   => $curso['imagem'],
                            ':link'   => $curso['link']
                         ]);
    }
}



