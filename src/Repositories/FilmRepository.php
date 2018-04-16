<?php

namespace Otus\Repositories;

use Otus\Core\DbConnection;
use Otus\Entities\Film;
use Otus\Helpers\DbQueryHelper;
use Otus\Interfaces\FilmInterface;
use Otus\Interfaces\FilmRepositoryInterface;
use PDO;
use PDOStatement;

class FilmRepository implements FilmRepositoryInterface
{
    /**
     * @var DbConnection
     */
    private $dbConnection;

    /**
     * FilmRepository constructor.
     *
     * @param DbConnection $dbConnection
     */
    public function __construct(DbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection->getConnection();
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularFilmsByGenre(array $genresList): array
    {
        $query = 'SELECT m.* FROM movies AS m
                  INNER JOIN ratings AS r ON m.id = r.movie_id
                  INNER JOIN genres_movies AS gm ON r.movie_id = gm.movie_id
                  INNER JOIN genres AS g ON gm.genre_id = g.id
                WHERE g.name IN (' . DbQueryHelper::getNoNamePlaceholdersList($genresList) . ')
                GROUP BY m.id
                ORDER BY AVG(r.rating) DESC;';

        $stm = $this->dbConnection
            ->prepare($query);

        foreach ($genresList as $key => $genre) {
            $stm->bindParam($key + 1, $genre, PDO::PARAM_STR);
        }

        $stm->execute();

        return $this->getFilmsFromResultSet($stm);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularFilmsByProfession(array $professionsList): array
    {
        $query = 'SELECT m.* FROM movies AS m
                  INNER JOIN ratings AS r ON m.id = r.movie_id
                  INNER JOIN users AS u ON r.user_id = u.id
                  INNER JOIN occupations AS o ON u.occupation_id = o.id
                WHERE o.name IN (' . DbQueryHelper::getNoNamePlaceholdersList($professionsList) . ')
                GROUP BY m.id
                ORDER BY AVG(r.rating) DESC LIMIT 50;';

        $stm = $this->dbConnection
            ->prepare($query);

        foreach ($professionsList as $key => $genre) {
            $stm->bindParam($key + 1, $genre, PDO::PARAM_STR);
        }

        $stm->execute();

        return $this->getFilmsFromResultSet($stm);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularFilmsByAgeRange(int $fromAge, int $toAge): array
    {
        $query = 'SELECT m.* FROM movies AS m
                  INNER JOIN ratings AS r ON m.id = r.movie_id
                  INNER JOIN users AS u ON r.user_id = u.id
                WHERE u.age BETWEEN :fromAge AND :toAge
                GROUP BY m.id
                ORDER BY AVG(r.rating) ASC;';

        $stm = $this->dbConnection
            ->prepare($query);

        $stm->bindParam(':fromAge', $fromAge, PDO::PARAM_INT);
        $stm->bindParam(':toAge', $toAge, PDO::PARAM_INT);

        $stm->execute();

        return $this->getFilmsFromResultSet($stm);
    }

    /**
     * {@inheritdoc}
     */
    public function getPopularFilmsByPeriod(int $fromYear, int $toYear): array
    {
        $query = 'SELECT m.* FROM movies AS m
                  WHERE EXTRACT(YEAR FROM m.release_date) BETWEEN :fromYear AND :toYear ORDER BY m.release_date ASC';

        $stm = $this->dbConnection
            ->prepare($query);

        $stm->bindParam(':fromYear', $fromYear, PDO::PARAM_STR);
        $stm->bindParam(':toYear', $toYear, PDO::PARAM_STR);

        $stm->execute();

        return $this->getFilmsFromResultSet($stm);
    }

    /**
     * @param PDOStatement $statement
     *
     * @return FilmInterface[]
     */
    private function getFilmsFromResultSet(PDOStatement $statement): array
    {
        $data = [];

        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new Film($row['id'], $row['title'], $row['release_date']);
        }

        return $data;
    }
}