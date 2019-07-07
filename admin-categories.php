<?php

    $app->get("/admin/categories", function(){

        User::verifyLogin();

        $categories = Category::listAll();

        $page = new PageAdmin();

        $page->setTpl("categories", [
            'categories'=>$categories
        ]);

    });

    $app->get("/admin/categories/create", function(){

        User::verifyLogin();

        $page = new PageAdmin();

        $page->setTpl("categories-create");

    });

    $app->post("/admin/categories/create", function(){

        User::verifyLogin();

        # carrega a classe na variável
        $category = new Category;

        # pega todos os campos do $_POST
        $category->setData($_POST);

        # chama o metodo na categoria para salvar os registros
        $category->save();

        # redireciona o usuário
        header("location: /admin/categories");

        # encerra o processo
        exit;

    });

    $app->get("/admin/categories/:idcategory/delete", function($idcategory){

        User::verifyLogin();

        # carrega a classe na variável
        $category = new Category();

        # pega a categoria no banco de dados
        $category->get((int)$idcategory);

        # chama o metodo na categoria para deletar o registros
        $category->delete();

        # redireciona o usuário
        header("location: /admin/categories");

        # encerra o processo
        exit;

    });

    $app->get("/admin/categories/:idcategory", function($idcategory){

        User::verifyLogin();

        # carrega a classe na variável
        $category = new Category();

        # pega a categoria no banco de dados
        $category->get((int)$idcategory);

        $page = new PageAdmin();

        # pega a página, aqui você dve indicar apenas o nome da página mais os parametros
        $page->setTpl("categories-update", [
            'category'=>$category->getValues()
        ]);

        # encerra o processo
        exit;

    });

    $app->post("/admin/categories/:idcategory", function($idcategory){

        User::verifyLogin();

        # carrega a classe na variável
        $category = new Category();

        # pega a categoria no banco de dados
        $category->get((int)$idcategory);

        # pega os dados enviados pela página de update
        $category->setData($_POST);

        # salva as alterações
        $category->save();

        # redireciona o usuário
        header("location: /admin/categories");

        # encerra o processo
        exit;

    });

    $app->get("/categories/:idcategory", function($idcategory){

        $category = new Category;

        $category->get((int)$idcategory);

        $page = new Page();

        $page->setTpl("category",[
            'category'=>$category->setValues(),
            'products'=>[]
        ]);

    });

?>