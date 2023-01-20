<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->post('/reg_form/registration',
            [
                'email' => 'example@gmail.com',
                'password' => 'qwerty123'
            ]);

        $response->assertStatus(200);
    }

    public function test_addProduct()
    {
        $response = $this->post('/add_product',
            [
                'email' => 'example@gmail.com',
                'name' => 'PlayStation',
                'price' => '1000',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque a dui non augue mattis commodo. Nam congue nibh tempor libero pharetra, non congue sem lobortis. Duis eget tellus in purus pretium posuere. In eget dolor auctor, posuere dolor eu, fermentum nisl. Fusce pretium purus sit amet aliquam iaculis. Phasellus semper suscipit libero vitae sodales. Phasellus tellus urna, gravida ac purus eu, suscipit fringilla nulla. Sed at enim ultricies, bibendum odio sit amet, aliquet enim. Praesent elementum leo ut purus ultrices, vitae elementum massa ornare. Nullam euismod urna sed nibh mollis, sed sollicitudin purus aliquet. Maecenas commodo sem quis magna dictum sagittis. Cras mollis vestibulum sodales. Mauris cursus at neque ut commodo. Quisque ullamcorper erat non tincidunt rutrum. Aenean vitae rhoncus neque.',
            ]);

        $response->assertStatus(200);
    }

    public function test_addImage()
    {
        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/add_image',
            [
                'productId' => '1',
                'file' => $file
            ]);

        $response->assertStatus(200);
    }

    public function test_deleteUser()
    {


        $response = $this->get('/users/1/delete');

        $response->assertStatus(200);
    }
}
