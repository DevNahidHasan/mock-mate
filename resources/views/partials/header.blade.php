<style>

    .navbar{
        background-color:#ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position:fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 50;
        height: 64px;
        
    }

    .navbar-container{
        margin: 0 auto;
        padding:0 1rem;
    }

    .navbar-flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
        height:64px;

    }

    .nick-name a{
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        color:black;
        padding:5px 10px;
    }

    .nick-name a:hover{
        opacity: 0.7;
    }

    .nav-btn ul{
        list-style: none;
        display: flex;
    }

    .nav-btn a{
        text-decoration: none;
        padding: 5px 10px;
        color: coral;
        cursor: pointer;

    }

    .nav-btn a:hover{
        background-color: coral;
        border-radius: 5px;
        color:white;
    }


</style>


<nav class="navbar">

    <div class="navbar-container">

        <div class="navbar-flex">

            <div class="nick-name">
                <a href="">HASAN</a>
            </div>
            

            <div class="nav-btn">
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="">ABOUT</a></li>
                    <li><a href="">EDUCATION</a></li>
                    <li><a href="">CERTIFICATIONS</a></li>
                    <li><a href="">PROJECTS</a></li>
                </ul>
            </div>

        </div>



    </div>



    


</nav>

<hr>