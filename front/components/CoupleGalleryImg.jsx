import Image from 'next/image'
import React from 'react'

const CoupleGalleryImg = ({coupleImg}) => {
  return (
    <div className='h-64 rounded-xl overflow-hidden relative'>
        <Image  
        src={coupleImg} 
        alt='photo de couple' 
        layout='fill' 
        className='object-cover'
        />
    </div>
  )
}

export default CoupleGalleryImg