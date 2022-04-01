<?php

namespace app\models;

use app\database\connection;
use app\database\contracts\crud;

class Product extends connection implements crud
{
    private $id, $name_en, $name_ar, $price, $quantity, $code, $image, $status,
        $details_en, $details_ar, $brand_id, $subcategory_id, $created_at, $updated_at;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name_en
     */
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }

    /**
     * Get the value of name_ar
     */
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of details_en
     */
    public function getDetails_en()
    {
        return $this->details_en;
    }

    /**
     * Set the value of details_en
     *
     * @return  self
     */
    public function setDetails_en($details_en)
    {
        $this->details_en = $details_en;

        return $this;
    }

    /**
     * Get the value of details_ar
     */
    public function getDetails_ar()
    {
        return $this->details_ar;
    }

    /**
     * Set the value of details_ar
     *
     * @return  self
     */
    public function setDetails_ar($details_ar)
    {
        $this->details_ar = $details_ar;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of subcategory_id
     */
    public function getSubcategory_id()
    {
        return $this->subcategory_id;
    }

    /**
     * Set the value of subcategory_id
     *
     * @return  self
     */
    public function setSubcategory_id($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function create()
    {
    }
    public function read()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }

    public function getProducts($filter = null)
    {
        $query = "SELECT `id`,`name_en`,`price`,`image`,`details_en` 
        FROM `products` WHERE `status` = {$this->status} 
        $filter 
        ORDER BY `price` ASC , `name_en` ASC , `created_at` ASC , `id` ASC";
        return $this->runDQL($query);
    }

// **********************************************************
    // recentProduct
    public function recentProduct($filter = null)
    {
        $query = "SELECT
         `products`.`id` AS      `products_id`  ,
        `products`.`name_en` AS  `products_name_en`  ,
        `products`.`price` AS    `products_price`  ,
        `products`.`image` AS     `products_image`,
        `products`.`desc_en` AS `products_desc_en`  ,
        `products`.`created_at` AS `products_created_at`

        FROM `products` 
        WHERE `status` = {$this->status} 
        $filter 
        ORDER BY `created_at` DESC 
        LIMIT 4";




        return $this->runDQL($query);
    }

    // mostRateProduct
    public function mostRateProduct($filter = null)
    {
        $query = "SELECT `products`.`id` AS `products_id`  ,
        `products`.`name_en` AS `products_name_en`  ,
        `products`.`price` AS `products_price`  ,
        `products`.`image` AS `products_image`,  
        `products`.`desc_en` AS `products_desc_en`  ,

         `reviews`.`rate` AS `reviewss`  
        FROM `products` 
        LEFT JOIN `reviews` ON `products`.`id`=`reviews`.`id_product`
        WHERE `status` = {$this->status} 
        $filter 
         GROUP BY `products_id` 
        ORDER BY `reviewss`  DESC ,AVG (`reviewss` )
        LIMIT 4;";

        return $this->runDQL($query);
    }


    // mostOrderProduct
    public function mostOrderProduct($filter = null)
    {
        $query = "SELECT 
        `products`.`id` AS `products_id`  ,
        `products`.`name_en` AS `products_name_en`  ,
        `products`.`price` AS `products_price`  ,
        `products`.`image` AS `products_image`  ,
        `products`.`desc_en` AS `products_desc_en`  ,
         `product_order`.`quantity` AS `product_order_quantity`  
               FROM `products` 
               LEFT JOIN `brands` ON `products`.`id_brand` = `brands`.`id` 
               LEFT JOIN `product_order`  ON `product_order`.`id_brand` = `brands`.`id`
            --    WHERE `status` = {$this->status} 
            --    $filter 
               GROUP BY `products_id` 
             ORDER BY `product_order_quantity` DESC 
             LIMIT 4";

        return $this->runDQL($query);
    }


// **********************************************************


    public function find()
    {
        $query = "SELECT * FROM `products` WHERE `status` = {$this->status} AND `id` = {$this->id}";
        return $this->runDQL($query);
    }

  
  
  
  
  
  
  
  
  
    public function getReviews()
    {
        $query = "SELECT
                    `reviews`.`product_id`,
                    `reviews`.`rate`,
                    `reviews`.`comments` AS `comment`,
                    `reviews`.`created_at`,
                    CONCAT(
                        `users`.`first_name`,
                        ' ',
                        `users`.`last_name`
                    ) AS `full_name`
                FROM
                    `reviews`
                JOIN `users`
                ON `users`.`id` = `reviews`.`user_id`
                WHERE
                    `product_id` = {$this->id}";
        return $this->runDQL($query);
    }
}
