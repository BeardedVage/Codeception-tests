# Ortnec

There are autotests for searching in google.

Instruction for launching in docker:
1. Install docker and docker compose
2. Open work directory in terminal
3. Launch the next commands to run tests for Yandex
   - docker-compose up -d
   - docker-compose run --rm codecept run acceptance --html result_yandex.html
4. Launch the next commands to run test for SEO
   - docker-compose run --rm codecept run seo --html result_seo.html
   
For launching in real chrome browser you should:
1. Edit path to chromedriver and selenium server in selenium.sh script
2. Run selenium.sh script
    - ./selenium.sh
3. Run command in terminal
    - codecept run acceptance --html result_yandex.html
    - codecept run seo --html result_seo.html
    
Results of tests you can see in terminal or you can open reports from tests/_output/