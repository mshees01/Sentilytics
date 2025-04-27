const track = document.querySelector('.carousel-track');
const cards = Array.from(document.querySelectorAll('.carousel-card'));
const indicatorsContainer = document.querySelector('.carousel-indicators');
let index = 0;
let autoSlideInterval;

// Clone first and last for infinite feel
const firstClone = cards[0].cloneNode(true);
const lastClone = cards[cards.length - 1].cloneNode(true);
track.appendChild(firstClone);
track.insertBefore(lastClone, track.firstChild);

const allCards = Array.from(document.querySelectorAll('.carousel-card'));

function updateCarousel() {
  const cardWidth = allCards[0].offsetWidth + 32; // 32px margin
  track.style.transform = `translateX(${-((index + 1) * cardWidth - window.innerWidth/2 + cardWidth/2)}px)`;

  allCards.forEach(card => card.classList.remove('active'));
  allCards[index + 1].classList.add('active');

  // Update indicators
  document.querySelectorAll('.carousel-indicators div').forEach(dot => dot.classList.remove('active'));
  indicatorsContainer.children[index % cards.length].classList.add('active');
}

function moveLeft() {
  if (index <= 0) {
    index = cards.length;
    track.style.transition = 'none';
    updateCarousel();
    setTimeout(() => {
      track.style.transition = 'transform 0.5s ease';
      index--;
      updateCarousel();
    }, 50);
  } else {
    index--;
    updateCarousel();
  }
}

function moveRight() {
  if (index >= cards.length - 1) {
    index = -1;
    track.style.transition = 'none';
    updateCarousel();
    setTimeout(() => {
      track.style.transition = 'transform 0.5s ease';
      index++;
      updateCarousel();
    }, 50);
  } else {
    index++;
    updateCarousel();
  }
}

function createIndicators() {
  cards.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.addEventListener('click', () => {
      index = i;
      updateCarousel();
    });
    indicatorsContainer.appendChild(dot);
  });
}

// Auto slide
function startAutoSlide() {
  autoSlideInterval = setInterval(moveRight, 2000);
}

// Stop auto slide on hover
document.querySelector('.carousel-wrapper').addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
document.querySelector('.carousel-wrapper').addEventListener('mouseleave', startAutoSlide);

window.addEventListener('resize', updateCarousel);

window.onload = () => {
  createIndicators();
  updateCarousel();
  startAutoSlide();
};
