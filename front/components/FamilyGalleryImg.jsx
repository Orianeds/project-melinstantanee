import React from 'react'
import Image from 'next/image'

const FamilyGalleryImg = ({familyImg}) => {
  return (
    <div className='h-64 rounded-xl overflow-hidden relative'>
        <Image
        src={familyImg}
        alt='photo de famille'
        layout='fill'
        className='object-cover'
        />
    </div>
  )
}

export default FamilyGalleryImg