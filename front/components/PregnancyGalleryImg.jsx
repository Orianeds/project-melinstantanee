import React from 'react'
import Image from 'next/image'

const PregnancyGalleryImg = ({pregnancyImg}) => {
  return (
    <div className='h-64 rounded-xl overflow-hidden relative'>
        <Image
        src={pregnancyImg}
        alt='photo de grossesse'
        layout='fill'
        className='object-cover'
        />
    </div>
  )
}

export default PregnancyGalleryImg