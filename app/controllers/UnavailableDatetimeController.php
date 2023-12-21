<?php

session_start();

class UnavailableDatetimeController extends RenderView
{
    public function create() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $msg = [];

        $unavailableDatetime = new UnavailableDatetimeModel();

        $datetime = $_POST['datetime'];

        if ($unavailableDatetime->create($datetime)) {
            $msg['success'] = "Data adicionada com sucesso!";
        } else {
            $msg['error'] = "Erro ao adicionar data.";
        }

        echo json_encode($msg);
    }

    public function edit($id) {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $auth = $this->authenticated;

        $productModel = new ProductModel();
        $product = $productModel->fetchProduct($id[0]);

        $user = new UserModel();
        $user = $user->fetchUserById($_SESSION['user_id']);

        if (!$product) {
        header('Location: ' . BASE_URL . 'login');
        }

        $this->loadView('pages/partials/header', [
        "title" => "Update Product",
        "isAuth" => $auth,
        'user' => $user
        ]);
        $this->loadView('pages/edit-product', [
        'product' => $product
        ]);
        $this->loadView('pages/partials/footer', []);
    }

    public function updateProduct()
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $msg = [];

        $service = new ServiceModel();

        if (!isset($_POST['name']) || empty($_POST['name'])) {
        $msg['error'] = "Preencha o campo Name!";
        } else if (!isset($_POST['price']) || empty($_POST['price'])) {
        $msg['error'] = "Preencha o campo Price!";
        } else if (!isset($_POST['image']) || empty($_POST['image'])) {
        $msg['error'] = "Preencha o campo Image!";
        } else if (!isset($_POST['id']) || empty($_POST['id'])) {
        $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
        } else {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $id = $_POST['id'];

        if ($product->update($name, $price, $image, $id)) {
            $msg['success'] = "Produto atualizado com sucesso!";
        } else {
            $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
        }
        }

        echo json_encode($msg);
    }

    public function delete($id)
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $unavailableDatetime = new UnavailableDatetimeModel();
        
        $msg = [];

        if ($unavailableDatetime->delete($id[0])) {
            $msg['success'] = "Data deletada com sucesso!";
        } else {
            $msg['error'] = "Erro ao deletar a data!";
        }

        echo json_encode($msg);
    }
}