<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <title>LearnVern Store</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css2?family=Ashom&display=swap" rel="stylesheet">

      <style>
            ul.dropdown-menu.show {
                  margin-left: -7px;
                  min-width: 1%;
            }

            i.fa-solid.fa-circle-arrow-left {
                  font-size: 42px;
                  color: #bebed1;
                  margin-bottom: 14px;
            }

            .card.mb-4.mb-xl-0 {
                  box-shadow: 0px -5px 25px 6px rgb(6 6 6 / 30%);
            }

            .card.mb-4 {
                  box-shadow: 0px -5px 25px 6px rgb(6 6 6 / 30%);
            }
      </style>
</head>

<body>


      @include('header_user')
      @yield('content')


      @include('footer_user')



      <script src="https://kit.fontawesome.com/b9304c053b.js" crossorigin="anonymous"></script>
</body>

</html>