<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ParseTextEditorContentTrait
{   
    /*
     * @param $content is request data from wysiwyg
     * @directory is where to save the images
     */
    public function parseTextEditorContent($content, $directory)
    {



        $dom = new \domdocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path().'/img/'.$directory.'/'.$image_name;
            $src = '/img/'.$directory.'/'.$image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', $src);
        }

        $content = $dom->savehtml();
        return $content;
    }
}
