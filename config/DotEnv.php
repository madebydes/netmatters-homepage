<?php
/**
 * DotEnv - Loads environment variables from .env file
 * 
 * Usage:
 *   $dotenv = new DotEnv(__DIR__ . '/.env');
 *   $dotenv->load();
 *   echo getenv('DB_HOST');
 */

class DotEnv
{
    protected $path;

    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("File not found: {$path}");
        }
        $this->path = $path;
    }

    public function load(): void
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException("File not readable: {$this->path}");
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Skip lines without =
            if (strpos($line, '=') === false) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }

            // Set environment variable
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv("{$name}={$value}");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
