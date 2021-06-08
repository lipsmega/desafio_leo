<?php

require_once 'classes/Curso.php';

class CursoList
{
    private $html;
    
    /**
     * Class constructor
     * Creates the listing
     */
    public function __construct()
    {
        
        $this->html = file_get_contents('html/item.html');
        
    }
    
    /**
     * Delete a record
     */
    public function delete($param)
    {
        try
        {
            $id = (int) $param['id'];
            Curso::delete($id);
        }
        catch (Exception $e)
        {
            print $e->getMessage();
        }
    }
    
    /**
     * Load the table with data
     */
    public function load($param = null)
    {
        try
        {

            $cursos = Curso::all();
            
            $items = '';
            $banner_novo = "<div class=\"banner-container\">
        <div class=\"banner\">Novo</div>
    </div>";

            foreach ($cursos as $curso)
            {  

                $item = $this->html;

                $item = str_replace( '{id}',    $curso['id'], $item);
                $item = str_replace( '{titulo}',    $curso['titulo'], $item);
                $item = str_replace( '{descricao}',    $curso['descricao'], $item);
                $item = str_replace( '{imagem}',    $curso['imagem'], $item);
                $item = str_replace( '{link}',    $curso['link'], $item);
                $item = str_replace( '{banner_novo}',    $banner_novo, $item);
                
                $items .= $item;
            }
            
            $this->html = "<div class=\"row\">".$items."</div>";
        }
        catch (Exception $e)
        {
            print $e->getMessage();
        }
    }
    
    /**
     * Shows the page
     */
    public function show()
    {
        $this->load();
        return $this->html;
    }
}
