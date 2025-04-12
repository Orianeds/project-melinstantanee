import React from 'react'
import styled from 'styled-components'
import Link from 'next/link';

const Portfolio = (props) => {
    const {img, textInfo, slug} = props.item;
  return (
    <Container className='portfolio'>
        <img src={img} alt="photos du portfolio" />
        <div className='textInfo'>

        <Link href={slug}><h3 className='textLibre'>{textInfo}</h3></Link>

        </div>
    </Container>
  )
}

export default Portfolio

const Container = styled.div`
    height: 532px;
    background-color: rgb( 211 184 165 / 0.4);
    margin: 0 0.5rem;
    padding: 0.5rem;
    border-radius: 5px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    &:hover {
        .textInfo{
            bottom: 0;
        }
    }
    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        // transition: transform 400ms ease-in-out;
    }
    .textInfo{
        position: absolute;
        background-size: cover;
        width: 100%;
        height: 532px;
        object-fit: cover;
        right: 0;
        left: 0;
        bottom: 100%;
        text-align: center;
        line-height: 532px;
        vertical-align: middle;
        padding: 0.5rem;
        background-color: rgb(0 0 0 / 0.8);
        font-size: 1.8rem;
        color: white;
        text-transform: uppercase;
    }
`