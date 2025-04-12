import React from 'react'
import Image from 'next/image'


const NewbornGalleryImg = ({newbornImg}) => {
  return (
    <div className='h-64 rounded-xl overflow-hidden relative'>
    <Image
    src={newbornImg}
    alt='photo de famille'
    layout='fill'
    className='object-cover'
    />
</div>
  )
}

export default NewbornGalleryImg