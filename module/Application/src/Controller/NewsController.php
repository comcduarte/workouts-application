<?php
namespace Application\Controller;

use Components\Controller\AbstractBaseController;
use Laminas\View\Model\ViewModel;

class NewsController extends AbstractBaseController
{
    public function updateAction()
    {
        $primary_key = $this->params()->fromRoute(strtolower($this->model->getPrimaryKey()),0);
        if (!$primary_key) {
            $this->flashmessenger()->addErrorMessage("Unable to retrieve record. Value not passed.");
            
            $url = $this->getRequest()->getHeader('Referer')->getUri();
            return $this->redirect()->toUrl($url);
        }
        
        $view = new ViewModel();
        $view->setTemplate('base/update');
        
        $this->model->read([$this->model->getPrimaryKey() => $primary_key]);
        
        $this->form->bind($this->model);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
                );
            $this->form->setData($data);
            
            if ($this->form->isValid()) {
                $this->model->update();
                $this->flashmessenger()->addSuccessMessage('Update Successful');
                
                $url = $this->getRequest()->getHeader('Referer')->getUri();
                return $this->redirect()->toUrl($url);
            } else {
                foreach ($this->form->getMessages() as $message) {
                    if (is_array($message)) {
                        $message = array_pop($message);
                    }
                    $this->flashMessenger()->addErrorMessage($message);
                }
            }
        }
        
        $view->setVariables([
            'form' => $this->form,
            'title' => 'Update Record',
            'primary_key' => $this->model->getPrimaryKey(),
        ]);
        
        return ($view);
    }
    
    public function getImageFileInfo($filePath)
    {
        // Try to open file
        if (!is_readable($filePath)) {
            return false;
        }
        
        // Get file size in bytes.
        $fileSize = filesize($filePath);
        
        // Get MIME type of the file.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        $mimeType = 'image/jpeg';
        if($mimeType===false)
            $mimeType = 'application/octet-stream';
            
            return [
                'size' => $fileSize,
                'type' => $mimeType
            ];
    }  
    
    public function getImageFileContent($filePath)
    {
        return file_get_contents($filePath);
    }
    
    public function imageAction() 
    {
        $fileName = './data/image.jpg';
        $this->layout('image');
        
        // Get image file info (size and MIME type).
        $fileInfo = $this->getImageFileInfo($fileName);
        if ($fileInfo===false) {
            // Set 404 Not Found status code
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        // Write HTTP headers.
//         $response = $this->getResponse();
//         $headers = $response->getHeaders();
//         $headers->addHeaderLine("Content-type: " . $fileInfo['type']);
//         $headers->addHeaderLine("Content-length: " . $fileInfo['size']);
        $view = new ViewModel();
        $view->setVariables([
            'TYPE' => $fileInfo['type'],
            'SIZE' => $fileInfo['size'],
            'NAME' => 'image.jpg',
            'data' => $this->getImageFileContent($fileName),
        ]);
        
        // Write file content.
//         $fileContent = $this->getImageFileContent($fileName);
//         if($fileContent!==false) {
//             $response->setContent($fileContent);
//         } else {
//             // Set 500 Server Error status code.
//             $this->getResponse()->setStatusCode(500);
//             return;
//         }
        
//         // Return Response to avoid default view rendering.
//         return $this->getResponse();
        return ($view);
    }
}