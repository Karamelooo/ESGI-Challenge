dans controller pour limiter les acces :

```php
    class YourController extends AbstractController
    {
        private $userService; // important

        // important
        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        /**
         * @Route("/your-page/{companyId}", name="your_page")
         */
        public function yourPage($companyId): Response
        {
            $this->denyAccessUnlessGranted('access_company', $this->getUser()); // important

            return $this->render('your_template.html.twig', [
                'companyId' => $companyId, // important
            ]);
        }
    }
```