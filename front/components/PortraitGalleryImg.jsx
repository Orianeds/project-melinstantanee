import React from 'react'
import Image from 'next/image'

const PortraitGalleryImg = ({portraitImg}) => {
  return (
    <div className='h-64 rounded-xl overflow-hidden relative'>
        <Image
        src={portraitImg}
        alt='photo de famille'
        layout='fill'
        className='object-cover'
        />
    </div>
  )
}

export default PortraitGalleryImg