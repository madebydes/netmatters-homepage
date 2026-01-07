<?php
/**
 * News Class
 * Handles fetching news posts from database
 */
class News
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Get latest news posts
     */
    public function getLatestPosts(int $limit = 3): array
    {
        $sql = "SELECT * FROM news_posts ORDER BY posted_date DESC, id DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get a single post by ID
     */
    public function getPostById(int $id): ?array
    {
        $sql = "SELECT * FROM news_posts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $post = $stmt->fetch();
        return $post ?: null;
    }

    /**
     * Get posts by category
     */
    public function getPostsByCategory(string $category, int $limit = 10): array
    {
        $sql = "SELECT * FROM news_posts WHERE category_slug = :category ORDER BY posted_date DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Format date for display
     */
    public static function formatDate(string $date): string
    {
        return date('jS F Y', strtotime($date));
    }
}
