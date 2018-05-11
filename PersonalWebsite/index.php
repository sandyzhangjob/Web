<?php
    require_once ('header.php');
?>
    <aside>
      <h2>Information</h2>
      
      <p>
        <img src="images/profile.jpg" alt="my photo" />
      </p>
      
      <div>
        <p>Name:</p>
        <p class="textintent">
          Shan(Sandy) Zhang
        </p>
        <p>Phone:</p>
        <p class="textintent">
          647-877-2268
        </p>
        <p>Email Address:</p>
        <p class="textintent">
          <a href="mailto:SandyZhang.job@gmail.com"> SandyZhang.job@gmail.com </a>
        </p>
        <p>Location: </p>
        <p class="textintent">
          North York, ON
        </p>
        <p>Working Experience: </p>
        <p class="textintent">
          CYOU.com (China&amp;US)
        </p>
        <p>Education:</p>
        <p class="textintent">
        <h6>Seneca College, Ontario - Computer Programmer (Ontario College Diploma) </h6>
        <h6>Hunan University of Science and Technology, China - Information and Computing Science (Bachelor of Science)</h6>
        </p>
      </div>
    </aside>

    <section class="main">
      <article id="idarticle1">
        <header class="entry-header">
          <h3>
            DB: Useful SQL Queries and Projects
            <a name="Article1"> </a>
          </h3>
        </header>
        <section class="entry-content">
          <p>
            •	According to a business table structure, provided corresponding queries, view, and result. <br />
            •	Based upon an example GTA Landscaping company’s description of operations, invoice statement and reports, performed normalizations (3NF), drew an ERD. Created databases, 3NF.<br />
            •	Tools: SQL, MySQL, ORACLE, PLSQL.<br />
            <br /><a href="https://github.com/sandyzhangjob/Database"> Github Link </a>
          </p>
       
        </section>
        <footer class="entry-footer">
          <p>Shan Zhang,  02/11/2018  Tags: Projects, MySQL, ORACLE</p>
        </footer>
      </article>

      <article id="idarticle2">
        <header class="entry-header">
          <h3>
            Web: Phone catalog Searching
            <a name="Article2"> </a>
          </h3>
        </header>
        <section class="entry-content">
          <p>
            •	Designed and developed a phone catalog searching program. A user can search phone list by providing specific information.<br />
            •	Customized Apache Web server with PHP module in a Linux system.<br />
            •	Designed and created MySQL databases, testing, security.<br />
            •	Tools: PHP5, MySQL5, Linux, LAMP.<br />
            <br /><a href="https://github.com/sandyzhangjob/Web/tree/master/PhoneSearch"> Github Link </a>
            <br /><a href="http://ec2-35-174-128-0.compute-1.amazonaws.com/PhoneSearch/assign1.php"> Phone catalog Searching Link </a>
          </p>
        </section>
        <footer class="entry-footer">
          <p>Shan Zhang,  02/12/2018  Tags: Projects</p>
        </footer>
      </article>

      <article id="idarticle3">
        <header class="entry-header">
          <h3>
            Web: User Login and Logout Page
            <a name="Article3"> </a>
          </h3>
        </header>
        <section class="entry-content">
          <p>
            •	Design and developed user Login and Logout page.<br />
            •	Tools: PHP5, session, mail.<br />
          </p>
          <br /><a href="https://github.com/sandyzhangjob/Web/tree/master/LoginAndLogout"> Github Link </a>
          <br /><a href="http://ec2-35-174-128-0.compute-1.amazonaws.com/LoginAndLogout/login.php"> User Login and Logout Page Link </a>
        </section>
        <footer class="entry-footer">
          <p>Shan Zhang,  02/13/2018  Tags: Projects</p>
        </footer>
      </article>

      <article id="idarticle4">
        <header class="entry-header">
          <h3>
            Web: Personal Website
            <a name="Article4"> </a>
          </h3>
        </header>
        <section class="entry-content">
          <p>
            •	Designed and developed a personal website, including text, gallery, video, audio, etc. <br />
            •	Tools: HTML, CSS, JavaScript, PHP, MySQL, Apache. <br />
          </p>
          <br /><a href="https://github.com/sandyzhangjob/Web/tree/master/PersonalWebsite"> Github Link </a>
          <br /><a href="http://ec2-35-174-128-0.compute-1.amazonaws.com/PersonalWebsite/index.html"> Personal Website Page Link </a>
        </section>
        <footer class="entry-footer">
          <p>Shan Zhang,  02/15/2018  Tags: Projects</p>
        </footer>
      </article>

    </section>

    <section class="links">
      <h2>Project's Link</h2>
      <p>
        <a href="#Article1">DB: Useful SQL Queries and Projects</a>
      </p>
      <p>
        <a href="#Article2">Web: Phone catalog Searching</a>
      </p>
      <p>
        <a href="#Article3">Web: User Login and Logout Page</a>
      </p>
      <p>
        <a href="#Article4">Web: Personal Website</a>
      </p>
    </section>

      <?php require('footer.php'); ?>
  </div>
</body>
</html>



