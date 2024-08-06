<?php

namespace App\Custom;

class EnvUpdater
{
    /**
     * Update the .env file with new properties.
     *
     * @param array $data
     * @return bool
     */
    public static function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= PHP_EOL . "{$key}={$value}";
            }
        }

        file_put_contents($envPath, $envContent);

        return true;
    }
}