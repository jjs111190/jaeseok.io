    // 스크롤 이벤트 추가
    window.addEventListener('scroll', function () {
        const nav = document.querySelector('nav'); // 내비게이션 요소 선택
        const navLinks = document.querySelectorAll('nav ul li a'); // 내비게이션 링크 선택
        const scrollY = window.scrollY; // 현재 스크롤 위치
    
        // 스크롤이 100px 이상일 때 글씨 크기를 작게 조정
        if (scrollY > 100) {
          nav.style.padding = '10px 0'; // 내비게이션 패딩을 줄임
          navLinks.forEach(link => link.style.fontSize = '0.8em'); // 글씨 크기를 줄임
        } else {
          nav.style.padding = '20px 0'; // 내비게이션 기본 패딩
          navLinks.forEach(link => link.style.fontSize = '1em'); // 글씨 크기를 원래대로
        }
      });
      
     
  var element = document.getElementById('myElement');
if (element) {
    element.classList.add('newClass');
}
var element = document.querySelector('.myClass');
console.log(element); // null이면 해당 클래스를 가진 요소가 없음
if (element) {
    element.classList.add('newClass');
}
