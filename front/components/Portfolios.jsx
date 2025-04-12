"use client";
import React from 'react'
import styled from 'styled-components';
import SliderComp from './Slider';

const Portfolios = () => {
  return (
    <Container id="portfolio" className='textLibre'>
        <h1>Portfolio</h1>
        <p>Voici quelques réalisations en fonction des séances proposées</p>
        <Slide>
            <SliderComp />
        </Slide>
    </Container>
  )
}

export default Portfolios

const Container = styled.div`
    width: 80%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 3rem 0;
    text-align: center;
    position: relative;
    @media(max-width: 840px){
        width: 90%;
    }
    h1{
        font-size: 1.9rem;
    }

    p{
        width: 28rem;
        margin: 0 auto;
        padding: 1rem 0;
        font-size: 0.9rem;
        @media(max-width : 500px){
            width: 90%;
        }
    }
`

const Slide = styled.div``
