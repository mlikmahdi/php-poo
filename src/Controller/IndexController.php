<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Lecturer;
use Application\Repository\LecturerRepository;
use Application\LecturerCollection;

class IndexController
{
    /**
     * @var LecturerRepository
    */
    private $lecturerRepository;

    public function __construct(LecturerRepository $lecturerRepository)
    {
        $this->lecturerRepository = $lecturerRepository;
    }

    public function indexAction() : string
    {
        /** @var LecturerCollection $lecturers */
        $lecturers = $this->lecturerRepository->findAll();

        ob_start();
        include __DIR__.'/../../views/index.phtml';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}