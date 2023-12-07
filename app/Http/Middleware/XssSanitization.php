<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use HTMLPurifier;
use HTMLPurifier_Config;
use Symfony\Component\HttpFoundation\Response;

class XssSanitization
{    
    public function handle(Request $request, Closure $next): Response
    {
        // Get all input data from the request
        $inputData = $request->all();

        // Sanitize each input value
        $sanitizedData = $this->sanitizeInput($inputData);

        // Replace the original input data with the sanitized data
        $request->replace($sanitizedData);

        // Continue with the request
        return $next($request);
    }

    private function sanitizeInput($inputData)
    {
        // Create HTML Purifier configuration
        $config = HTMLPurifier_Config::createDefault();

        // Customize the configuration if needed
        // $config->set('some_config_option', 'some_value');

        // Create the HTML Purifier instance
        $purifier = new HTMLPurifier($config);

        // dd($inputData);

        // Iterate through each input value and sanitize it
        foreach ($inputData as $key => $value) {
            if(is_array($value)){

            }else{
                $inputData[$key] = $purifier->purify($value);
            }            
        }

        return $inputData;
    }
}
