<?php extract($_GET); ?>
<section class="banner">

    <div class="banner-holder">
    <div class="search-bg"></div>
        <div class="search-box">
            <div class="box">
            <form action="faculty.php">
                <select name="subject" >
                    <option value="0">Subject</option>
                    <?php echo getOption($subdata); ?>
                </select>
                <select name="syllabus">
                    <option value="0">Syllabus</option>
                    <?php echo getOption($sydata); ?>
                </select>
                <select name="class">
                    <option value="0">Class</option>
                    <?php echo getOption($cldata); ?>
                </select>
                <input type="submit" id="submit_banner_search" value="Search" />
            </form>
            </div>
        </div>

    </div>
</section>