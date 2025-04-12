import React, { useRef } from 'react'
import Slider from 'react-slick';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import Portfolio from './Portfolio'
import styled from 'styled-components';
import { IoIosArrowBack, IoIosArrowForward } from "react-icons/io";

let data = [
    {
        img: "/newbornPhotos/newbornImg1.jpg",
        textInfo: "Séance Nouveau Né",
        slug: "portfolio/nouveau-ne"
    },
    {
        img: "/famillePhotos/familyImg1.jpg",
        textInfo: "Séance Famille",
        slug: "portfolio/famille"
    },
    {
        img: "/couplePhotos/coupleImg9.jpg",
        textInfo: "Séance Couple",
        slug: "portfolio/couple"
    },
    {
        img: "/pregnancyPhotos/pregnancyImg9.jpg",
        textInfo: "Séance Grossesse",
        slug: "portfolio/grossesse"
    },
    {
        img: "/portraitPhotos/portraitImg1.jpg",
        textInfo: "Séance Portrait",
        slug:"portfolio/portrait"
    }
]

var settings = {
    className: "center",
    dots: true,
    infinite: false,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    initialSlide: 0,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          initialSlide: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  };


const SliderComp = () => {
    const arrowRef = useRef(null);
    let sliderPortfolio;
    sliderPortfolio = data.map((item, i) => (
        <Portfolio item= {item} key= {i} />
    ))

  return (
    <Container>
        <Slider ref={arrowRef} {...settings}>
            {sliderPortfolio}
        </Slider>
        <Buttons>
        <button 
        onClick={() => arrowRef.current.slickPrev()}
        className='back'><IoIosArrowBack/></button>
        <button 
        onClick={() => arrowRef.current.slickNext()}
        className='next'><IoIosArrowForward/></button>
      </Buttons>
    </Container>
    
  )
}

export default SliderComp

const Container = styled.div`
position: relative;
`

const Buttons = styled.div`
  button{
    width: 2rem;
    height: 2rem;
    cursor: pointer;
    color: #d3b8a5;
    border: none;
    position: absolute;
    top: 45%;
    right: -1.5rem;
  }

  .back{
    left: -1rem;
  }
`