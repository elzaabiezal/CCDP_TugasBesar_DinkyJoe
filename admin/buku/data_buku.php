<?php

interface BukuFactory
{
    public function createBuku($type);
}

class AddBukuFactory implements BukuFactory
{
    public function createBuku($type)
    {
        if ($type == "add") {
            return new AddBuku();
        } else {
            throw new Exception("Invalid buku type");
        }
    }
}

class EditBukuFactory implements BukuFactory
{
    public function createBuku($type)
    {
        if ($type == "edit") {
            return new EditBuku();
        } else {
            throw new Exception("Invalid buku type");
        }
    }
}

class DelBukuFactory implements BukuFactory
{
    public function createBuku($type)
    {
        if ($type == "del") {
            return new DelBuku();
        } else {
            throw new Exception("Invalid buku type");
        }
    }
}

$bukuFactory = new AddBukuFactory();
$buku = $bukuFactory->createBuku("add");

$buku->tambahDataBuku();