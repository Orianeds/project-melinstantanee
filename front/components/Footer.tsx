import React from 'react'
import Image from 'next/image'
import Link from 'next/link'

const Footer = () => {
  return (
    <footer className='bg-brown text-white'>
          <div className=' flex-col columns-2 items-strech justify-between mb-10 pt-8'>
            <h1 className='font-bold text-3xl ml-8'>Mel'instantanée</h1>
              <ul className='flex justify-end mx-[4rem]'>
                <li className='mx-4'>
                  <Link href='https://www.instagram.com/melissa_daigre/' target='_blank'><Image src='/instagram.png' width={40} height={40} alt="logo instagram" /></Link>
                </li>
                <li className='mx-4'>
                  <Link href="https://www.facebook.com/?locale=fr_FR" target='_blank'><Image src='/facebook.png' width={40} height={40} alt='logo facebook'></Image></Link>
                </li>
                <li className='mx-4'>
                  <Link href="https://calendly.com/" target='_blank'><Image src='/calendly.png' width={40} height={40} alt='logo calendly'></Image></Link>
                </li>
            </ul>
          </div>
          <div className='text-center border-t-[.1rem] border-t-white border-t-solid'>
            <p className='pt-1'>© 2023 Mel'instantanée, photographe</p>
            <p>Site réalisé par Oriane Da Silva</p>
          </div>
    </footer>
  )
}

export default Footer