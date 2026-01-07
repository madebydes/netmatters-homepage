<?php
/**
 * Contact Class
 * Handles contact form validation and storage
 */
class Contact
{
    private PDO $db;
    private array $errors = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Validate contact form data
     */
    public function validate(array $data): bool
    {
        $this->errors = [];

        // Name validation
        if (empty($data['name'])) {
            $this->errors['name'] = 'Name is required';
        } elseif (strlen($data['name']) < 2) {
            $this->errors['name'] = 'Name must be at least 2 characters';
        }

        // Email validation
        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Please enter a valid email address';
        }

        // Phone validation (required)
        if (empty($data['phone'])) {
            $this->errors['phone'] = 'Phone number is required';
        } else {
            $phone = preg_replace('/[^0-9+]/', '', $data['phone']);
            if (strlen($phone) < 10) {
                $this->errors['phone'] = 'Please enter a valid phone number';
            }
        }

        // Message validation
        if (empty($data['message'])) {
            $this->errors['message'] = 'Message is required';
        } elseif (strlen($data['message']) < 10) {
            $this->errors['message'] = 'Message must be at least 10 characters';
        }

        return empty($this->errors);
    }

    /**
     * Get validation errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Save contact submission to database
     */
    public function save(array $data): bool
    {
        $sql = "INSERT INTO contact_submissions (name, email, phone, company, message, marketing_consent, ip_address) 
                VALUES (:name, :email, :phone, :company, :message, :marketing_consent, :ip_address)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'] ?? null,
            ':company' => $data['company'] ?? null,
            ':message' => $data['message'],
            ':marketing_consent' => $data['marketing_consent'] ? 1 : 0,
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
    }

    /**
     * Get all contact submissions
     */
    public function getSubmissions(int $limit = 50): array
    {
        $sql = "SELECT * FROM contact_submissions ORDER BY submitted_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
