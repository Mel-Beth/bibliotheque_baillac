PGDMP  ,    1    
            |            bibliotheque_baillac    17.2    17.2 0    &           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            '           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            (           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            )           1262    20112    bibliotheque_baillac    DATABASE     �   CREATE DATABASE bibliotheque_baillac WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_France.1252';
 $   DROP DATABASE bibliotheque_baillac;
                     postgres    false            *           0    0    DATABASE bibliotheque_baillac    ACL     |   GRANT ALL ON DATABASE bibliotheque_baillac TO collaborateur1;
GRANT ALL ON DATABASE bibliotheque_baillac TO collaborateur2;
                        postgres    false    4905            �            1259    20222 	   adherents    TABLE     �   CREATE TABLE public.adherents (
    id integer NOT NULL,
    id_adherent bigint,
    nom character varying(100),
    prenom character varying(100),
    date_inscription date,
    email character varying(100),
    telephone character varying(20)
);
    DROP TABLE public.adherents;
       public         heap r       postgres    false            �            1259    20221    adherents_id_seq    SEQUENCE     �   CREATE SEQUENCE public.adherents_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.adherents_id_seq;
       public               postgres    false    227            +           0    0    adherents_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.adherents_id_seq OWNED BY public.adherents.id;
          public               postgres    false    226            �            1259    20114    employes    TABLE     X  CREATE TABLE public.employes (
    id_employe integer NOT NULL,
    nom character varying(50) NOT NULL,
    prenom character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    telephone character varying(15),
    role character varying(20) NOT NULL,
    mot_de_passe character varying(255) NOT NULL,
    batiment character varying(10) NOT NULL,
    etage character varying(10) NOT NULL,
    CONSTRAINT employes_role_check CHECK (((role)::text = ANY ((ARRAY['responsable'::character varying, 'responsable_site'::character varying, 'bibliothecaire'::character varying])::text[])))
);
    DROP TABLE public.employes;
       public         heap r       postgres    false            �            1259    20113    employes_id_employe_seq    SEQUENCE     �   CREATE SEQUENCE public.employes_id_employe_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.employes_id_employe_seq;
       public               postgres    false    218            ,           0    0    employes_id_employe_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.employes_id_employe_seq OWNED BY public.employes.id_employe;
          public               postgres    false    217            �            1259    20131    exemplaires    TABLE     �   CREATE TABLE public.exemplaires (
    id integer NOT NULL,
    isbn character(13) NOT NULL,
    etat text NOT NULL,
    id_exemplaire character varying(20) NOT NULL
);
    DROP TABLE public.exemplaires;
       public         heap r       postgres    false            �            1259    20130    exemplaires_id_exemplaire_seq    SEQUENCE     �   CREATE SEQUENCE public.exemplaires_id_exemplaire_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.exemplaires_id_exemplaire_seq;
       public               postgres    false    221            -           0    0    exemplaires_id_exemplaire_seq    SEQUENCE OWNED BY     T   ALTER SEQUENCE public.exemplaires_id_exemplaire_seq OWNED BY public.exemplaires.id;
          public               postgres    false    220            �            1259    20163    historique_transactions    TABLE     <  CREATE TABLE public.historique_transactions (
    id_transaction integer NOT NULL,
    id_adherent character(13) NOT NULL,
    id_employe integer NOT NULL,
    date_emprunt date NOT NULL,
    date_retour date,
    commentaire text,
    isbn character varying(20),
    id_exemplaire character varying(10) NOT NULL
);
 +   DROP TABLE public.historique_transactions;
       public         heap r       postgres    false            �            1259    20162 *   historique_transactions_id_transaction_seq    SEQUENCE     �   CREATE SEQUENCE public.historique_transactions_id_transaction_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 A   DROP SEQUENCE public.historique_transactions_id_transaction_seq;
       public               postgres    false    225            .           0    0 *   historique_transactions_id_transaction_seq    SEQUENCE OWNED BY     y   ALTER SEQUENCE public.historique_transactions_id_transaction_seq OWNED BY public.historique_transactions.id_transaction;
          public               postgres    false    224            �            1259    20123    livres    TABLE     K  CREATE TABLE public.livres (
    isbn character(13) NOT NULL,
    titre character varying(255) NOT NULL,
    auteur character varying(100) NOT NULL,
    genre character varying(50),
    editeur character varying(100),
    annee_publication integer,
    resume text,
    nombre_de_pages integer,
    langue character varying(50)
);
    DROP TABLE public.livres;
       public         heap r       postgres    false            �            1259    20144    qrcodes    TABLE     �   CREATE TABLE public.qrcodes (
    id_qrcode integer NOT NULL,
    id_exemplaire integer NOT NULL,
    chemin_qrcode character varying(255) NOT NULL
);
    DROP TABLE public.qrcodes;
       public         heap r       postgres    false            �            1259    20143    qrcodes_id_qrcode_seq    SEQUENCE     �   CREATE SEQUENCE public.qrcodes_id_qrcode_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.qrcodes_id_qrcode_seq;
       public               postgres    false    223            /           0    0    qrcodes_id_qrcode_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.qrcodes_id_qrcode_seq OWNED BY public.qrcodes.id_qrcode;
          public               postgres    false    222            s           2604    20225    adherents id    DEFAULT     l   ALTER TABLE ONLY public.adherents ALTER COLUMN id SET DEFAULT nextval('public.adherents_id_seq'::regclass);
 ;   ALTER TABLE public.adherents ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    226    227    227            o           2604    20117    employes id_employe    DEFAULT     z   ALTER TABLE ONLY public.employes ALTER COLUMN id_employe SET DEFAULT nextval('public.employes_id_employe_seq'::regclass);
 B   ALTER TABLE public.employes ALTER COLUMN id_employe DROP DEFAULT;
       public               postgres    false    217    218    218            p           2604    20134    exemplaires id    DEFAULT     {   ALTER TABLE ONLY public.exemplaires ALTER COLUMN id SET DEFAULT nextval('public.exemplaires_id_exemplaire_seq'::regclass);
 =   ALTER TABLE public.exemplaires ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    220    221    221            r           2604    20166 &   historique_transactions id_transaction    DEFAULT     �   ALTER TABLE ONLY public.historique_transactions ALTER COLUMN id_transaction SET DEFAULT nextval('public.historique_transactions_id_transaction_seq'::regclass);
 U   ALTER TABLE public.historique_transactions ALTER COLUMN id_transaction DROP DEFAULT;
       public               postgres    false    225    224    225            q           2604    20147    qrcodes id_qrcode    DEFAULT     v   ALTER TABLE ONLY public.qrcodes ALTER COLUMN id_qrcode SET DEFAULT nextval('public.qrcodes_id_qrcode_seq'::regclass);
 @   ALTER TABLE public.qrcodes ALTER COLUMN id_qrcode DROP DEFAULT;
       public               postgres    false    223    222    223            #          0    20222 	   adherents 
   TABLE DATA           e   COPY public.adherents (id, id_adherent, nom, prenom, date_inscription, email, telephone) FROM stdin;
    public               postgres    false    227   �<                 0    20114    employes 
   TABLE DATA           r   COPY public.employes (id_employe, nom, prenom, email, telephone, role, mot_de_passe, batiment, etage) FROM stdin;
    public               postgres    false    218   B?                 0    20131    exemplaires 
   TABLE DATA           D   COPY public.exemplaires (id, isbn, etat, id_exemplaire) FROM stdin;
    public               postgres    false    221   �B       !          0    20163    historique_transactions 
   TABLE DATA           �   COPY public.historique_transactions (id_transaction, id_adherent, id_employe, date_emprunt, date_retour, commentaire, isbn, id_exemplaire) FROM stdin;
    public               postgres    false    225   �E                 0    20123    livres 
   TABLE DATA           y   COPY public.livres (isbn, titre, auteur, genre, editeur, annee_publication, resume, nombre_de_pages, langue) FROM stdin;
    public               postgres    false    219   �M                 0    20144    qrcodes 
   TABLE DATA           J   COPY public.qrcodes (id_qrcode, id_exemplaire, chemin_qrcode) FROM stdin;
    public               postgres    false    223   �_       0           0    0    adherents_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.adherents_id_seq', 14, true);
          public               postgres    false    226            1           0    0    employes_id_employe_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.employes_id_employe_seq', 11, true);
          public               postgres    false    217            2           0    0    exemplaires_id_exemplaire_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.exemplaires_id_exemplaire_seq', 90, true);
          public               postgres    false    220            3           0    0 *   historique_transactions_id_transaction_seq    SEQUENCE SET     Y   SELECT pg_catalog.setval('public.historique_transactions_id_transaction_seq', 90, true);
          public               postgres    false    224            4           0    0    qrcodes_id_qrcode_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.qrcodes_id_qrcode_seq', 1, false);
          public               postgres    false    222            �           2606    20229 #   adherents adherents_id_adherent_key 
   CONSTRAINT     e   ALTER TABLE ONLY public.adherents
    ADD CONSTRAINT adherents_id_adherent_key UNIQUE (id_adherent);
 M   ALTER TABLE ONLY public.adherents DROP CONSTRAINT adherents_id_adherent_key;
       public                 postgres    false    227            �           2606    20227    adherents adherents_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.adherents
    ADD CONSTRAINT adherents_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.adherents DROP CONSTRAINT adherents_pkey;
       public                 postgres    false    227            v           2606    20122    employes employes_email_key 
   CONSTRAINT     W   ALTER TABLE ONLY public.employes
    ADD CONSTRAINT employes_email_key UNIQUE (email);
 E   ALTER TABLE ONLY public.employes DROP CONSTRAINT employes_email_key;
       public                 postgres    false    218            x           2606    20120    employes employes_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.employes
    ADD CONSTRAINT employes_pkey PRIMARY KEY (id_employe);
 @   ALTER TABLE ONLY public.employes DROP CONSTRAINT employes_pkey;
       public                 postgres    false    218            |           2606    20137    exemplaires exemplaires_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.exemplaires
    ADD CONSTRAINT exemplaires_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.exemplaires DROP CONSTRAINT exemplaires_pkey;
       public                 postgres    false    221            �           2606    20170 4   historique_transactions historique_transactions_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.historique_transactions
    ADD CONSTRAINT historique_transactions_pkey PRIMARY KEY (id_transaction);
 ^   ALTER TABLE ONLY public.historique_transactions DROP CONSTRAINT historique_transactions_pkey;
       public                 postgres    false    225            z           2606    20129    livres livres_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.livres
    ADD CONSTRAINT livres_pkey PRIMARY KEY (isbn);
 <   ALTER TABLE ONLY public.livres DROP CONSTRAINT livres_pkey;
       public                 postgres    false    219            ~           2606    20149    qrcodes qrcodes_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.qrcodes
    ADD CONSTRAINT qrcodes_pkey PRIMARY KEY (id_qrcode);
 >   ALTER TABLE ONLY public.qrcodes DROP CONSTRAINT qrcodes_pkey;
       public                 postgres    false    223            �           2606    20138 !   exemplaires exemplaires_isbn_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.exemplaires
    ADD CONSTRAINT exemplaires_isbn_fkey FOREIGN KEY (isbn) REFERENCES public.livres(isbn) ON DELETE CASCADE;
 K   ALTER TABLE ONLY public.exemplaires DROP CONSTRAINT exemplaires_isbn_fkey;
       public               postgres    false    4730    221    219            �           2606    20181 ?   historique_transactions historique_transactions_id_employe_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historique_transactions
    ADD CONSTRAINT historique_transactions_id_employe_fkey FOREIGN KEY (id_employe) REFERENCES public.employes(id_employe);
 i   ALTER TABLE ONLY public.historique_transactions DROP CONSTRAINT historique_transactions_id_employe_fkey;
       public               postgres    false    218    4728    225            �           2606    20150 "   qrcodes qrcodes_id_exemplaire_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.qrcodes
    ADD CONSTRAINT qrcodes_id_exemplaire_fkey FOREIGN KEY (id_exemplaire) REFERENCES public.exemplaires(id);
 L   ALTER TABLE ONLY public.qrcodes DROP CONSTRAINT qrcodes_id_exemplaire_fkey;
       public               postgres    false    221    4732    223            #   P  x�uSIn�0<7_�H`s�-�� ����pd&#C�D��(�;�cim�����F�XUDЈJZ+i��xh���b�*�B�L��3����w�W�Uʋ��\*�����$8�e�Fi/���T�e��=��4Qb��I���ղ�3x�,7�+�� ��
�M�p��l�2�f"�P$����B���������Ai���&�բO��|^���sc�{�g��ڻ���F��]l�ᢊe�V}!CŌ������.KW&-h%�r�k�B���5����2u%ł�"�3�SNJ�4�����4�7i(�DR�ڲ�H�D������i����ԃC�BY)����cߧ8���q��L��ˤ�>�`ޭ��|�J��������ϱ+�_��KU�� 3tP�X�c�9�-R(}�(ةC"�7�)��X�S�F
譊n��A0ē�k��R���o��������j�a��yK�,�! �,<fm�*�nǊ��}�&�K�������J�ۈ%Cu\���}��Ǯ,V�v��T�iv�So8�`�����w��cw��oYQ�&����/�����[����F         ]  x�}�˒�8�u|�Y�:�Ma7���^���
!r����y�~�A�>�g�,>"�U�8�9X�2iS`��v����8+1<%��{_~�;!�c���L�c	wRӍ�3��<_�΁`��Y�Zl���B��u�I����!��
�Pۡ�a�U(�e3�6�P�G��w��ľ0��z���5�>@��QFBy	u0M�U��2=��n���ƄD����_��(�p��Er#���g��Ľ 	�&B�O�⨛Dw�3cu.���[󱴟���#�
o=;0����$���x`���9�(j6��!�� ��7@�0�}����6�U�*Y�x4�f��Q���|1� ������n-��	���0X�< QS`�<�	/@&���z��l����
^��l�ع�Ɂ�	�O��v���~aJ�~��gc��|���!�PHp�y�!z�oD�Wg���CV_�T�/U��N>t��Kpt�$>�E��Ȥ�M�]k�d�V�����Qb`���hVA�>�7������Z[���m�4�׺l��Z^)��3��U:Ӽn�J�5�ε]ٚ��+$iZ�1����6�����6�'����y�;�
�u��hA��{	��M0E�!�ז=C��X[����(	($L(�c6˅!t��L9.�$.��B�z�>[�؜��?��7zv!���N`��u��9�o�:7=�a!����az@C��f����	��_�kO��+�!�!�G�_��w4����i��T��d��
��\�yj���o�[�a`�<zLg��O<���z�!��ߘ���o�jOkƛ&�ah-�b��Sq�@p���v�U��x+#�cd^0RW�7��\�	t���N���Y         �  x���9�A��Sp�}I��	H��� X$��Q8�]=�p�����z��\h��D O��z����ݧg?|~�|{�@�	�Z��~~�?������AY���< fWA�ۋ��U���C���@��̄��6��tr|����U�Ar %2�7 iz�<Ȯ��l�bV M�A��Ay����ɜ���+�/LY�WOU��W����!k���Pu4�5�@�D�@8���§�	TH�n��ੱ�c���!Sg͚$VC],%؀�N!Set�r�*o�J�!�12F�@ �u�D�?BC����X�l��C��,
ƥ/�>�F<|�T��T�sk)
g����f��ȊZ}�t<W�d9�uS _S�Lv��)i�6�ߎNe#x�n�WoH7�Ne�Ie]Z�
��apQ����G�P��F�ͱMM�b������aҀ���P�P�s��:�]B2l*�Ts~����x����(��W]��뇗X=�'�"C�L��b�g��+3k\�^���墂��@uX�^����?V�U�l�q���� �� �%S�����Z�җnS1�,�ue�}����KN��.�q�J,Ε��wJ{9��@}�phF�I�x��Ldz�я���eM�n1��y��EY�H�����9����Q��MoH7�� �%k����,��o�٘�I�t9�pM���?���b��?6Cڐ]V�]Be�)�;��s�h�z	���7��� XS4^      !   �  x��Zˎ7<�bn�x6߼��1H�S��wgr�����|��"�){��K�vFlR��N�50��)��U�ݴj�֖�1Zن%��!uC~x�7�n�o~��m��ۯ��m��-���oo׫]�ڷ�v�������/������&� ����+4��"���֨h�6AyըhO�Z6�/�n�>��Wo�O�~�����q�����M�دvX�fux�#��c4�G�4$�A�d6�F�t�(=�W�/�!��9��Dmtc��L
��g^�Fyc��'.��C�O������f��o�v�ߴ��f�-V���~ٵ�7��}���V�=�v�\�OӉ*��%X�����CN�ƥ�ƴټ�A�����_�/�����v��q��& 2���Y�1���"��c��/�N�����{@�&��M���.P�wO��vJI$g�ު�N�]������kH�lrN:�#^h�${��w�9��k��������5��N|���l�^\�D;�(U����|�Ǩ̗>h-c@��i��5�Y�C�}-�?.j�5h4b�& ����TKڅ�߭����a����ߏ�m�}�o�;,�����n�~�>�y~0��ם+B�t@ɹQH �y�s��NUuH~����-��#�E=c6�/�
*5%1Q���H_�W	��)�@�:�>B+Ʌp�$)(^�A	���!�WT)I�����w�z�	�������]�s	Ǌ\�C�9���G�7�#=���a����0�OX O�D¹�������p��R2�#3Y���(�r&>��	��;]�P���9�+S,���JG�fvI����?{ٰ���)�L�V���j������\c@	��q��4S�������r��%���s��P�*+�
�N�T���k�@x�4�<05����3��d�����L�b^���&�Q��2%�_D�v%+�c}����6#�5k��Ҫ���Y���]���� l��;�����O{��ݯ��n}���������q�8ŭ �BC|P��1E�Rq�����<�U
�t�/f؟��[��3��ж =۔��d%� tY�h.-'��_�g�a.��cE�;5����xm$7J5`/���[k��v;[H��̡�+����� �%Т��,��b�-���D���S�^��i���X���<�"�0`���.֨B���q�խsD]	����n����[��v*����p@��m�x/2���E�Y5@��Y	RJO�+l�����u���~I-��Qݩ�Cr�+��[��S�Ո�ƈ.7�?L(,��Ir��ȴ��i(���^67� ���^䅕�4�9�xU'��Y}<Y�-+�dA2r�֠�L���)��8�Z�\(kϷ@��B�92�x��*{�a��?h�\Uńi�(�@��sb�3XV���W�c�H�j~h[w�O#^�C�*��SV�%������>���B��K������Wƚ��?��~���zmQ<X=ɖ�E`�y`�r?f�
�4�TN0�T�/^�m/i�2��d��#S�TT;]���������r�&���:��8�L��c}d�����:-o���u���h$���e���:ur�d��hʯr��Mqw_~ ��ԉ�v%�(
��0&���.c��a�����|�t��TV%}}#`	�5�=��}�+�6'��U �CݖI��;�r�~R�ɝu2L�(��0#]�t��1�t�PQ��>u�5t��H��R����^�&�Ɔ�YD%]
@'�+.��%���k蒃Y�1+:����j��%�]���Y,���Z�1��rݹ��U+�s�z�l#1�,f�����n#4P��Egv�������~(�5lc�*;#��ٽ��B�P\/t��Bef�ߐ��	�h+�17+����˶W=���k<1�s&X�);\��l�+L�.P_��D���a\f�(��=G���_��%�a
R��F�b�[6�D�U
c�D�E�ʆ)�eB�+G���o���et>            x��[ɒ�F�=C_�[]D��X,R\���Q��mms�BFf	 �X�d����c}�#m�k�G� ��f�fFk
��ߞ?�p�i�eq��#s.y���v��>m�[�����i�w����� �ι.��ۈNȺu/d[��	<?t�\s�=��a���em!jVw+�n5_�7��Ϋ��v�,��,Kr?ϓ<ʝ_�7��.���s_Yʝ��{��^�����~f]�p�̣����mh�Ͻpq�7?+�d���,�ј{3l��s^�J&Z:[�^�a�+�]ȾĹ�@�M�\��tq�N������x��2�rլ��j�l�v{�k8�պ/�����#-�v�3��F�	QXѹ->����tNk�XN{3��~��Q���������?h���(e+{R���{ɋk;�W�H��V�f�����Ǌ����)�n_q���ֺ[YoX�����Z5g��</����a5I�a��0�`�����t㜗7���W�n;ݟ��z҉�R%��W68�,-�j�^7�A��w�[Y���x�ֲk8���=�[���H�ǭ�75w� ��
C/ς��R��
퍢\���(�u�����IP	��o�d��۵Jֶ�\	٢�E�v7g��Z%��;���}���{����qo�a�*LZq�h�(�l��$c��G�X�� X�����u �5+Ey���Zx_-��;�CV*!�D�x���R�C#���<V8Q���;�4��˜��[��AL縀�d�qr@�M_1����ze�~c�`�	�7�É`�%�)L;��m�χq��=p��hɿ�@�2�!��a�ت�������V典�h�QPM>\C�7ǻ���1P38�u�+�5���&�Sr�[���Ll���߲���W0V��5*l�e��׼hx78�E/ZAG=��l�!��#1��B6;!�_$��1��Dx-��R�#��g~��#�:�g�1�����M���F{�7'*̉��A4s�0�4��$Q��D���3B��)�v~ᤧ��-`z�mk	v�}���4kj7�Y͖����!�(��:�iK�@��,���I�&�w�^7so�R�A@>q��^�9�ӓ0QU�f'���k�`�y
��eO =d1� H	d,��Y�`H�|�g��~`������j<�X�;�X�T����z�U}`e��*O���<)��t(q��_df�8#�R6�Q\G e`�\${��gr�ۺ��&
?!Ź��-w�ɛ֙����SY��V�
��(�Zu�m�@�neS������ ��$��'����d��	�+J�|B*�F�7��i���y�`I��!1����2}>���3|�m=�2F�P��Iz������sU��J�K�bH �0�t��׳�?;�D*s*����� �a�z�z؅$Z�v��.�^"�c�h�>24:~����ܽ��y�S��q�(�#|�K�� 6@�Q�'��ׯ)՟no؂�$��=�H�v��K�m��%��_��F������P���p��(~��vԎ?D�b��f�d~��3��Р�������lJYݬ��WƇ5/�|Oe3,#�J�,��V�سzw/��MR��y�@�S?�S���b ϲ��Wy�y���=�w���I�_E�+�Q��Oݼ�mp�Q�}��H_�@�o�_U��\���U�Ɖ�BK�E���ͳ�v�����$�l�%<�����$°t��I�k>��gt\T�����:~���p��8O�!�T���l0�[^2*okbC$����F���ޜ����`�L�~����vϝ(\��{��&&����'8����F~Y�c7a�7�y�YV�s3�f���{bo�Q��v2�Sѭ�R�{�o@������<��&�Ι)1RNK����,(<���
����2���Uʂj�����5n�����`u���9j�x�F��KB১��E��(o���/�cyKPw_8���n���hh��p|�R���3��Vt�+�}�Ԃ��N$~	f��	"�WI�I�=|z���홡�?
�r�<��ױ=�Y$,����6k���:h]�BY2�	�a���M3Z��+�F��cpA؈m�ݾ��gޛ:E����a�`�@����.je!�"�e��sh&��g#{��zI�v �� �3Z���Z�0U��.쟦~#�����+xًg��y�Yq�ey�F^�{6I�E"f�GXp�U�5����	T�:KOk�D'ŏMO3m���V�m+�\t��3�*d���a�~��7gD��9(��ו����pΣ�ـ	��g�j�1��G�q�-���� �+���-1�j��߶��a�����wY!��؎��y�6Z�"j�N�J��J�KJ$��ț �"'�ښ"�x���x�N���w/Xu��z����%T����J�!�h���&o>��l�D�gQ�x�m%�ڽ3���z�XG�[嗀P��N[�n������)�H%�^�l����I�Z;�`F�Ѕt���X����,^��p��+�i&֠KM��F[h�,��Ö! H�b�:����e��"v�-q4��@�����[xR����?H��3:O�2B�D0ċ�@�Rk؋Co�K��L}I]�K���˕L?�P)��*��h�'�T�he9h���&k[�mk�M�ɋ� �9Yt��$��4.��?���-�׈T'��F����oZ��ֶ��[p{[�ɞȐ��[s'�P��ƥ�-���(����9�6��w$�$�
kT�u�:h���m������(̶�N*k�0���Hdʸ�|I8 �X�M����Wk0O{���"z�^Y�*%�2�<��� ;#����}�i�E�̾)%��=�&W�9����p��E�"!�A�L���	�u�@x*FB/~r/K�m����=5֬����x~��pJd��Vj��F0�]�^��a>�]W��-6����,��~�
������n�r-nS%@DP�D��+MS7'��x'=�5_D��8u����G�Ux����^���-I���A����`�� _w�' �7��'��J�{.�&�������O
P��G�A�3z~'���{�<�>�����E��������A���o};T�6�����r��j�Wl�{�P������Z`=�[^�2�2߂�!� ��U�u}}��������-���|���=�t���Ѽ$T�&�a��a���r���b3n��a���ɸ�7��_7y��7��ħ>�E�\��GF�&GpR���lxy$�(�Ҵ�=�K����qSWs�q����ծ�7˻Z�ڸ��90ݭ�>�^j����U�ȃ�s�wT��x�C}�xw�����5����?4�a��:{(H-4z�5��-H�I�h��,�3璢jN������#Ms�<rx8Q�����;U���E*V�Ԫ�bL2�C�y��T���Q���1}���3��膯�7S�}��q�=����B��`!�����N�T�(�J�y��|�jB���JT�
"4�Z��'Hb��G��'�,�8���G� .\
%A��^�vE�,Y�۹�۴|x4z�8�!aO3�K�Y��h��8V �p{*�"oY��!��� �gok:��\�3�A�t7]I����BV7�\7)��z5�m�{O�G��G�t�P�E�ʳ�A�<L�0����j0�+�-�6�ˆ�>V4=N�iM�
�@��ܦ_!��u[��4���i%T���>մ�
.���z��gh��`��#��'n<���Lm�d�o��:��&x\̥Q;���|�������8rQ�I�&��hl{�O�� A�/'H����%[q�(>�/Q�*��_.��F����7�c��4m~�o:(l)L���J'��'r���i�kg�u�5���^t�r�F{����V��+	:W;A�W)\��:l�jgO�B3ݩ�hU'��g4��6<����A"c�1T�����F<oA�}�|�`��.�9*jH�Vi��iYb�w-E�#C�2�ԯ�]�����91�]���y-ا��._�PV�$� )!�i����]`\�K   �2�=x+J�=k�6P�b���$�P]���'Ak�zH�  �DN�%9��372v�\�U��yO�TR�&k�gjEە4?YۦK�~{h���&�B�8��$�|s{~����7]��)j�vL�6<ęL����]j����*[7���?�����
�3]S�s0*�4�3�����5�;x�}�6����L��%_���
F�׼K�eX�֙�q����A���.oi'�5]J�f}��(�~���	�q�B�9�4]h�ٱ�}�x/�ʬ���n&b�ItM�AG��N;M��q�//5���?�FT���'q�M����C����_	n��h.\f	��[���{�������	�?�c��J�(�Pa#�������;�����O��eʦxu���
�JsG~6�āg���~�RN��~�^ۍ��@a�kC�	�	��V*�}�OY���?�8����<
��M9�Ĩ��^7�}I#o�_י�U���}�9�4Q/A<�TV]�ZW{'��o�����(�$            x������ � �     