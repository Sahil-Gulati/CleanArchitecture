<?php
namespace usecases\actions;

class DeleteProduct {
    public function delete(\entities\Product $product) {
        $this->validateProduct($product);
        if($this->repository->isExists($product)) {
            $this->repository->deleteProduct($product);
            return true;
        }
        throw new \entities\exception\ProductNotExistsException();
    }
}