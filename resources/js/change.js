

  function changeDisplay() {
    var searchOption = document.getElementById('searchOption');
    var searchByTitle = document.querySelector('.searchByTitle');
    var searchByAuthor = document.querySelector('.searchByAuthor');

    if (searchOption.value === 'Title') {
      searchByTitle.style.display = 'block';
      searchByAuthor.style.display = 'none';
    } else if (searchOption.value === 'Author') {
      searchByTitle.style.display = 'none';
      searchByAuthor.style.display = 'block';
    }
  }

//chua co tac dung