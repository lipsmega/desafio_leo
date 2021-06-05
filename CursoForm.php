<?php

require_once 'classes/Curso.php';

class CursoForm
{
    private $html;
    private $data;
    
    /**
     * Class constructor
     * Creates the listing
     */
    public function __construct()
    {
        
        $this->html = file_get_contents('html/form.html');

        $this->data = [ 'id'        => null,
                        'titulo'      => null,
                        'descricao'      => null,
                        'imagem'      => null,
                        'link'  => null];  
        
    }
    
    /**
     * Load object to form data
     */
    public function edit($param)
    {
        try
        {
            $id = (int) $param['id'];
            $this->data = Curso::find($id);
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }
    }

    /**
     * Save form data
     */
    public function save($param)
    {
        try
        {
            Curso::save($param);
            $this->data = $param;
            print "Record saved";
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }

    }

    /**
     * Shows the page
     */
    public function show()
    {
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{titulo}', $this->data['titulo'], $this->html);
        $this->html = str_replace('{descricao}', $this->data['descricao'], $this->html);
        $this->html = str_replace('{imagem}', $this->data['imagem'], $this->html);
        $this->html = str_replace('{link}', $this->data['link'], $this->html);

        return $this->html;
    }
}
